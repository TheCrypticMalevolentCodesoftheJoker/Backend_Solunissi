<?php

namespace Modules\Produccion\Presentation\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use App\Models\TblAlmacenMaterial; // inventario
use App\Models\TblInventarioMovimiento; // inventario
use App\Models\TblInventarioMovimientoDetalle;  // inventario
use App\Models\TblProyecto; // Proyecto
use App\Models\TblSMPendiente;
use App\Models\TblSMPendienteDetalle;
use App\Models\TblSolicitudCompra; // compra
use App\Models\TblSolicitudCompraDetalle; // compra
use App\Models\TblSolicitudDespacho; // logistica
use App\Models\TblSolicitudDespachoDetalle; // logistica
use App\Models\TblSolicitudMaterial; // produccion
use App\Models\TblSolicitudMaterialDetalle; // produccion
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class ProyectoSolicitudMaterialController extends Controller
{
    public function index()
    {
        try {
            $solicitudes = TblSolicitudMaterial::with([
                'tbl_proyecto',
                'tbl_solicitud_material_detalles.tbl_material'
            ])
                ->orderBy('fecha_solicitud', 'desc')
                ->get();

            $dto = new MessageDTO(
                true,
                $solicitudes->isEmpty()
                    ? "No se encontraron solicitudes de material"
                    : "Listado obtenido correctamente",
                200,
                $solicitudes
            );

            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            return new ApiResponseResource(
                new MessageDTO(false, $e->getMessage(), 500, null)
            );
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // 1. Validar y obtener el proyecto destino de la solicitud
            $proyecto = TblProyecto::findOrFail($request->proyecto_id);
            // 2. Registrar la solicitud principal (encabezado)
            $solicitud = TblSolicitudMaterial::create([
                'codigo' => 'SOLM-' . str_pad(TblSolicitudMaterial::max('id') + 1, 5, '0', STR_PAD_LEFT),
                'proyecto_id' => $proyecto->id,
                'fecha_solicitud' => now(),
                'estado' => 'Pendiente',
            ]);
            // 3. Registrar el detalle solicitado (por cada material)
            foreach ($request->materiales as $m) {
                TblSolicitudMaterialDetalle::create([
                    'solicitud_material_id' => $solicitud->id,
                    'material_id' => $m['material_id'],
                    'cantidad' => $m['cantidad']
                ]);
            }
            // 4. Preparar arreglos para determinar qué se despacha y qué se compra
            $detalleDespacho = [];
            $detalleCompra = [];
            // 5. Evaluar stock por cada material y dividir: lo disponible (despacho) y lo faltante (compra)
            foreach ($request->materiales as $m) {
                $almacenMaterial = TblAlmacenMaterial::where('almacen_id', $proyecto->almacen_id)
                    ->where('proyecto_id', $proyecto->id)
                    ->where('material_id', $m['material_id'])
                    ->first();

                $cantidadSolicitada = $m['cantidad'];
                // 5.1 Si el material existe en almacén y tiene stock → se genera despacho parcial o total
                if ($almacenMaterial && $almacenMaterial->stock > 0) {
                    $cantidadDespacho = min($cantidadSolicitada, $almacenMaterial->stock);
                    // Registrar cantidad a despachar
                    $detalleDespacho[] = [
                        'material_id' => $m['material_id'],
                        'cantidad' => $cantidadDespacho
                    ];
                    // Actualizar stock del almacén
                    $almacenMaterial->stock -= $cantidadDespacho;
                    $almacenMaterial->save();
                    // Registrar movimiento de inventario (Salida)
                    $movimiento = TblInventarioMovimiento::create([
                        'almacen_origen_id' => $proyecto->almacen_id,
                        'almacen_destino_id' => null,
                        'proyecto_id' => $proyecto->id,
                        'tipo' => 'Salida',
                        'referencia' => $solicitud->codigo,
                        'origen_movimiento' => 'Produccion',
                        'fecha_movimiento' => now(),
                    ]);
                    // Registrar detalle del movimiento
                    TblInventarioMovimientoDetalle::create([
                        'inventario_movimiento_id' => $movimiento->id,
                        'material_id' => $m['material_id'],
                        'cantidad' => $cantidadDespacho
                    ]);
                    // Restar lo ya despachado del total solicitado
                    $cantidadSolicitada -= $cantidadDespacho;
                }
                // 5.2 Si queda cantidad pendiente → se agrega a la lista de compra
                if ($cantidadSolicitada > 0) {
                    $detalleCompra[] = [
                        'material_id' => $m['material_id'],
                        'cantidad' => $cantidadSolicitada
                    ];
                }
            }
            // 6. Registrar solicitud de despacho (lo que sí se puede entregar desde almacén)
            $despacho = null;
            if (!empty($detalleDespacho)) {
                $despacho = TblSolicitudDespacho::create([
                    'solicitud_material_id' => $solicitud->id,
                    'proyecto_id' => $proyecto->id,
                    'fecha_solicitud' => now(),
                    'estado' => 'Pendiente',
                ]);

                foreach ($detalleDespacho as $d) {
                    TblSolicitudDespachoDetalle::create(array_merge($d, [
                        'solicitud_despacho_id' => $despacho->id
                    ]));
                }
            }
            // 7a. Registrar respaldo de materiales pendientes
            if (!empty($detalleCompra)) {
                $respaldo = TblSMPendiente::create([
                    'solicitud_material_id' => $solicitud->id,
                    'proyecto_id' => $proyecto->id,
                    'fecha' => now(),
                    'estado' => 'Pendiente',
                ]);

                foreach ($detalleCompra as $c) {
                    TblSMPendienteDetalle::create([
                        's_m_pendiente_id' => $respaldo->id,
                        'material_id' => $c['material_id'],
                        'cantidad' => $c['cantidad']
                    ]);
                }
            }

            // 7b. Registrar solicitud de compra (lo que falta en almacén)
            $compra = null;
            if (!empty($detalleCompra)) {
                $compra = TblSolicitudCompra::create([
                    'codigo' => 'SOLCPR-' . str_pad(TblSolicitudCompra::max('id') + 1, 5, '0', STR_PAD_LEFT),
                    'solicitud_material_id' => $solicitud->id,
                    'proyecto_id' => $proyecto->id,
                    'fecha_solicitud' => now(),
                    'estado' => 'Pendiente',
                ]);

                foreach ($detalleCompra as $c) {
                    TblSolicitudCompraDetalle::create(array_merge($c, [
                        'solicitud_compra_id' => $compra->id
                    ]));
                }
            }

            // 8. Determinar estado final de la solicitud (completa, parcial o pendiente)
            if (!empty($detalleCompra) && !empty($detalleDespacho)) {
                $solicitud->estado = 'Incompleta';
            } elseif (!empty($detalleCompra) && empty($detalleDespacho)) {
                $solicitud->estado = 'Pendiente';
            } elseif (empty($detalleCompra) && !empty($detalleDespacho)) {
                $solicitud->estado = 'Completa';
            } else {
                $solicitud->estado = 'Pendiente';
            }
            $solicitud->save();

            DB::commit();

            $dto = new MessageDTO(true, "Solicitud de materiales registrada correctamente", 201, null);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            DB::rollBack();
            $dto = new MessageDTO(false, $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }

    public function show($id)
    {
        try {
            $solicitud = TblSolicitudMaterial::with([
                'tbl_proyecto',
                'tbl_solicitud_material_detalles.tbl_material'
            ])
                ->find($id);

            if (!$solicitud) {
                return new ApiResponseResource(
                    new MessageDTO(false, "Solicitud no encontrada", 404, null)
                );
            }

            $dto = new MessageDTO(
                true,
                "Solicitud obtenida correctamente",
                200,
                $solicitud
            );

            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            return new ApiResponseResource(
                new MessageDTO(false, $e->getMessage(), 500, null)
            );
        }
    }
}
