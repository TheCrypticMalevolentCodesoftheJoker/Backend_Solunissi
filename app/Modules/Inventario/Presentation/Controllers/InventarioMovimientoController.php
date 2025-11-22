<?php

namespace Modules\Inventario\Presentation\Controllers;

use App\Models\TblAlmacenMaterial;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TblContrato;
use App\Models\TblInventarioMovimiento;
use App\Models\TblInventarioMovimientoDetalle;
use App\Models\TblOrdenCompra;
use App\Models\TblTraslado;
use App\Models\TblTrasladoDetalle;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class InventarioMovimientoController extends Controller
{
    public function index()
    {
        try {
            $contratos = TblContrato::with([
                'tbl_cliente.tbl_lead',
                'tbl_proyectos'
            ])
                ->orderBy('id', 'desc')
                ->get();

            if ($contratos->isEmpty()) {
                $dto = new MessageDTO(true, 'No hay contratos registrados', 200, []);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, 'Listado de contratos', 200, $contratos);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, 'Error al obtener contratos: ' . $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            // 1) Registrar movimiento de inventario
            $movimiento = TblInventarioMovimiento::create([
                'almacen_origen_id'  => $request->almacen_origen_id,
                'almacen_destino_id' => $request->almacen_destino_id,
                'proyecto_id'        => $request->proyecto_id,
                'tipo'               => $request->tipo,
                'referencia'         => $request->referencia,
                'origen_movimiento'  => 'Compra',
                'fecha_movimiento'   => now(),
            ]);

            // 2) Buscar la Orden de Compra por referencia
            $orden = TblOrdenCompra::where('codigo', $request->referencia)->first();

            if ($orden) {
                // Cambiar el estado a ENTREGADO
                $orden->update([
                    'estado' => 'Entregado'
                ]);
            }

            // 3) Registrar detalles + actualizar stock
            foreach ($request->detalle as $item) {

                // Registrar detalle del movimiento
                TblInventarioMovimientoDetalle::create([
                    'inventario_movimiento_id' => $movimiento->id,
                    'material_id' => $item['material_id'],
                    'cantidad'    => $item['cantidad'],
                ]);

                // Actualizar o crear stock en almacén
                $almacenMaterial = TblAlmacenMaterial::where('almacen_id', $request->almacen_destino_id)
                    ->where('material_id', $item['material_id'])
                    ->first();

                if ($almacenMaterial) {
                    $almacenMaterial->update([
                        'stock' => $almacenMaterial->stock + $item['cantidad']
                    ]);
                } else {
                    TblAlmacenMaterial::create([
                        'almacen_id'  => $request->almacen_destino_id,
                        'proyecto_id' => null,
                        'material_id' => $item['material_id'],
                        'stock'       => $item['cantidad'],
                        'stock_minimo' => 0,
                        'stock_maximo' => 0,
                    ]);
                }
            }

            if ($orden) {

                $cotizacion = $orden->tbl_cotizacion;

                if ($cotizacion && $cotizacion->tbl_solicitud_material) {

                    $solicitud = $cotizacion->tbl_solicitud_material;

                    $proyectoId = $solicitud->proyecto_id;
                    $almacenDestinoId = $solicitud->almacen_id;

                    $traslado = TblTraslado::create([
                        'almacen_origen_id'  => $request->almacen_origen_id,
                        'almacen_destino_id' => $almacenDestinoId,
                        'proyecto_id'        => $proyectoId,
                        'referencia'         => $request->referencia,
                        'origen_traslado'    => 'Entrada desde OC',
                        'fecha_traslado'     => now(),
                        'estado'             => 'Pendiente'
                    ]);

                    foreach ($request->detalle as $item) {
                        TblTrasladoDetalle::create([
                            'traslado_id' => $traslado->id,
                            'material_id' => $item['material_id'],
                            'cantidad'    => $item['cantidad']
                        ]);
                    }
                }
            }

            DB::commit();

            return new ApiResponseResource(
                new MessageDTO(true, 'Movimiento registrado correctamente', 201, $movimiento->id)
            );
        } catch (\Exception $e) {

            DB::rollBack();

            return new ApiResponseResource(
                new MessageDTO(false, $e->getMessage(), 500, null)
            );
        }
    }
}
