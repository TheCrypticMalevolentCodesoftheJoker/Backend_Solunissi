<?php

namespace Modules\Compra\Presentation\Controllers;

use App\Models\TblCotizacion;
use App\Models\TblCotizacionDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class ContizacionController extends Controller
{
    public function index()
    {
        try {
            $cotizaciones = TblCotizacion::with([
                'tbl_solicitud_compra',
                'tbl_cotizacion_detalles.tbl_material',
                'tbl_proveedor',
            ])
                ->orderBy('fecha_cotizacion', 'desc')
                ->get();

            if ($cotizaciones->isEmpty()) {
                return new ApiResponseResource(
                    new MessageDTO(
                        true,
                        "No existen cotizaciones registradas",
                        200,
                        []
                    )
                );
            }

            return new ApiResponseResource(
                new MessageDTO(
                    true,
                    "Listado de cotizaciones obtenido correctamente",
                    200,
                    $cotizaciones
                )
            );
        } catch (\Exception $e) {
            return new ApiResponseResource(
                new MessageDTO(false, "Error al obtener cotizaciones: " . $e->getMessage(), 500, null)
            );
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $cotizacion = TblCotizacion::create([
                'codigo' => 'COT-' . str_pad(TblCotizacion::max('id') + 1, 5, '0', STR_PAD_LEFT),
                'solicitud_compra_id' => $request->solicitud_compra_id,
                'proveedor_id'        => $request->proveedor_id,
                'fecha_cotizacion'    => $request->fecha_cotizacion,
                'tiempo_entrega_dias' => $request->tiempo_entrega_dias,
                'costo_envio'         => $request->costo_envio,
                'descuento'           => $request->descuento,
                'total'               => 0,
                'estado'              => 'Registrado',
            ]);

            $total = 0;
            foreach ($request->input('detalles', []) as $detalle) {
                $subtotal = $detalle['cantidad'] * $detalle['precio_unitario'];
                $total += $subtotal;

                TblCotizacionDetalle::create([
                    'cotizacion_id'   => $cotizacion->id,
                    'material_id'     => $detalle['material_id'],
                    'cantidad'        => $detalle['cantidad'],
                    'precio_unitario' => $detalle['precio_unitario'],
                    'subtotal'        => $subtotal,
                ]);
            }
            $totalFinal = $total + ($cotizacion->costo_envio ?? 0) - ($cotizacion->descuento ?? 0);
            $cotizacion->update(['total' => $totalFinal]);

            DB::commit();
            $dto = new MessageDTO(true, "Cotización registrada correctamente", 201, null);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            DB::rollBack();
            $code = (int) $e->getCode();
            if ($code === 0) {
                $code = 500;
            }
            $dto = new MessageDTO(false, $e->getMessage(), $code, null);
            return new ApiResponseResource($dto);
        }
    }

    public function show($id)
    {
        try {
            $cotizacion = TblCotizacion::with([
                'tbl_solicitud_compra',
                'tbl_cotizacion_detalles.tbl_material',
                'tbl_proveedor',
            ])->findOrFail($id);

            return new ApiResponseResource(
                new MessageDTO(
                    true,
                    "Detalle de la cotización obtenido correctamente",
                    200,
                    $cotizacion
                )
            );
        } catch (\Exception $e) {
            return new ApiResponseResource(
                new MessageDTO(
                    false,
                    "Cotización no encontrada: " . $e->getMessage(),
                    404,
                    null
                )
            );
        }
    }

    public function showByIdSolicitudCompra($solicitudCompraId)
    {
        try {
            $cotizaciones = TblCotizacion::with([
                'tbl_solicitud_compra',
                'tbl_cotizacion_detalles.tbl_material',
                'tbl_proveedor',
            ])
                ->where('solicitud_compra_id', $solicitudCompraId)
                ->orderBy('fecha_cotizacion', 'desc')
                ->get();

            if ($cotizaciones->isEmpty()) {
                return new ApiResponseResource(
                    new MessageDTO(
                        true,
                        "No existen cotizaciones registradas para esta solicitud de compra",
                        200,
                        []
                    )
                );
            }

            return new ApiResponseResource(
                new MessageDTO(
                    true,
                    "Listado de cotizaciones para la solicitud de compra obtenido correctamente",
                    200,
                    $cotizaciones
                )
            );
        } catch (\Exception $e) {
            return new ApiResponseResource(
                new MessageDTO(
                    false,
                    "Error al obtener cotizaciones: " . $e->getMessage(),
                    500,
                    null
                )
            );
        }
    }
}
