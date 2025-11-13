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
                'tbl_proyecto:id,nombre',
                'tbl_proveedor:id,razon_social,ruc,correo',
                'tbl_solicitud_compra:id,fecha_solicitud,estado',
                'tbl_cotizacion_detalles.tbl_material:id,nombre,unidad_medida'
            ])
                ->orderBy('fecha_cotizacion', 'desc')
                ->get();

            $dto = new MessageDTO(
                true,
                "Listado de cotizaciones obtenido correctamente",
                200,
                $cotizaciones
            );

            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $cotizacion = TblCotizacion::create([
                'solicitud_compra_id' => $request->input('solicitud_compra_id'),
                'proveedor_id'        => $request->input('proveedor_id'),
                'proyecto_id'         => $request->input('proyecto_id'),
                'fecha_cotizacion'    => $request->input('fecha_cotizacion'),
                'tiempo_entrega_dias' => $request->input('tiempo_entrega_dias'),
                'costo_envio'         => $request->input('costo_envio', 0),
                'descuento'           => $request->input('descuento', 0),
                'total'               => 0,
                'estado'              => 'Pendiente',
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

            $dto = new MessageDTO(
                true,
                "Cotización registrada correctamente",
                201,
                $cotizacion->load('tbl_cotizacion_detalles')
            );

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
                'tbl_proyecto:id,nombre',
                'tbl_proveedor:id,razon_social,ruc,correo,telefono',
                'tbl_solicitud_compra:id,fecha_solicitud,estado',
                'tbl_cotizacion_detalles.tbl_material:id,nombre,unidad_medida'
            ])->findOrFail($id);

            $dto = new MessageDTO(true, "Cotización obtenida correctamente", 200, $cotizacion);

            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, "Cotización no encontrada", 404, null);
            return new ApiResponseResource($dto);
        }
    }
    
    public function showBySolicitud($solicitudId)
    {
        try {
            $cotizaciones = TblCotizacion::with([
                'tbl_proyecto:id,nombre',
                'tbl_proveedor:id,razon_social,ruc,correo,telefono',
                'tbl_solicitud_compra:id,fecha_solicitud,estado',
                'tbl_cotizacion_detalles.tbl_material:id,nombre,unidad_medida'
            ])
                ->where('solicitud_compra_id', $solicitudId)
                ->orderBy('fecha_cotizacion', 'desc')
                ->get();

            if ($cotizaciones->isEmpty()) {
                $dto = new MessageDTO(false, "No existen cotizaciones para esta solicitud", 404, []);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, "Cotizaciones obtenidas correctamente", 200, $cotizaciones);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }
}
