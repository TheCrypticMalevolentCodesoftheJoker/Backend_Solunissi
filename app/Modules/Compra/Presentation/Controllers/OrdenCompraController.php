<?php

namespace Modules\Compra\Presentation\Controllers;

use App\Models\TblCotizacion;
use App\Models\TblOrdenCompra;
use App\Models\TblTransaccionContable;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class OrdenCompraController extends Controller
{
    public function index()
    {
        try {
            $ordenes = TblOrdenCompra::with(['tbl_cotizacion'])
                ->orderBy('fecha_emision', 'desc')
                ->get();

            if ($ordenes->isEmpty()) {
                return new ApiResponseResource(
                    new MessageDTO(
                        true,
                        "No existen órdenes de compra registradas",
                        200,
                        []
                    )
                );
            }

            return new ApiResponseResource(
                new MessageDTO(
                    true,
                    "Listado de órdenes de compra obtenido correctamente",
                    200,
                    $ordenes
                )
            );
        } catch (\Exception $e) {
            return new ApiResponseResource(
                new MessageDTO(
                    false,
                    "Error al obtener las órdenes de compra: " . $e->getMessage(),
                    500,
                    null
                )
            );
        }
    }

    public function store($id)
    {
        DB::beginTransaction();

        try {
            $cotizacion = TblCotizacion::findOrFail($id);

            $orden = TblOrdenCompra::create([
                'codigo' => 'OC-' . str_pad(TblOrdenCompra::max('id') + 1, 5, '0', STR_PAD_LEFT),
                'cotizacion_id' => $cotizacion->id,
                'total_orden_compra' => $cotizacion->total,
                'fecha_emision' => now(),
                'estado' => 'Por aprobar',
            ]);

            $proyectoId = optional($orden->tbl_cotizacion->tbl_compra)->proyecto_id;

            if ($proyectoId) {
                TblTransaccionContable::create([
                    'fecha_registro'               => now(),
                    'proyecto_id'                  => $proyectoId,
                    'tipo_transaccion_contable_id' => 4,
                    'centro_costo_id'              => 1,
                    'monto_total'                  => $orden->total_orden_compra,
                    'modulo_origen'                => 'COMPRAS',
                    'referencia_id'                => $orden->codigo,
                    'descripcion'                  => "Registro de orden de compra {$orden->codigo}",
                    'estado'                       => 'Pendiente',
                ]);
            }

            $cotizacion->estado = 'Orden Generada';
            $cotizacion->save();

            DB::commit();

            return new ApiResponseResource(
                new MessageDTO(
                    true,
                    "Orden de compra registrada correctamente y cotización marcada como ejecutada",
                    201,
                    null
                )
            );
        } catch (\Exception $e) {
            DB::rollBack();

            return new ApiResponseResource(
                new MessageDTO(
                    false,
                    "Error al registrar la orden de compra: " . $e->getMessage(),
                    500,
                    null
                )
            );
        }
    }


    public function show($id)
    {
        try {
            $orden = TblOrdenCompra::with(['tbl_cotizacion'])
                ->findOrFail($id);

            return new ApiResponseResource(
                new MessageDTO(
                    true,
                    "Detalle de la orden de compra obtenido correctamente",
                    200,
                    $orden
                )
            );
        } catch (\Exception $e) {
            return new ApiResponseResource(
                new MessageDTO(
                    false,
                    "Orden de compra no encontrada",
                    404,
                    null
                )
            );
        }
    }
}
