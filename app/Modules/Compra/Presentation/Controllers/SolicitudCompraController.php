<?php

namespace Modules\Compra\Presentation\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use App\Models\TblSolicitudCompra;
use App\Models\TblSolicitudCompraDetalle;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class SolicitudCompraController extends Controller
{
    public function index()
    {
        try {
            $solicitudes = TblSolicitudCompra::with([
                'tbl_proyecto:id,nombre',
                'tbl_empleado:id,nombres,apellidos',
                'tbl_solicitud_compra_detalles.tbl_material:id,nombre,unidad_medida'
            ])
                ->orderBy('fecha_solicitud', 'desc')
                ->get();

            $dto = new MessageDTO(
                true,
                "Listado de solicitudes de compra obtenido correctamente",
                200,
                $solicitudes
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
            $solicitud = TblSolicitudCompra::create([
                'proyecto_id'     => $request->input('proyecto_id'),
                'supervisor_id'   => $request->input('supervisor_id'),
                'fecha_solicitud' => $request->input('fecha_solicitud'),
                'estado'          => 'Pendiente',
            ]);

            foreach ($request->input('detalles', []) as $detalle) {
                TblSolicitudCompraDetalle::create([
                    'solicitud_compra_id' => $solicitud->id,
                    'material_id'         => $detalle['material_id'],
                    'unidad_medida'       => $detalle['unidad_medida'],
                    'cantidad'            => $detalle['cantidad'],
                ]);
            }

            DB::commit();

            $dto = new MessageDTO(
                true,
                "Solicitud de compra registrada correctamente",
                201,
                $solicitud->load('tbl_solicitud_compra_detalles')
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
            $solicitud = TblSolicitudCompra::with([
                'tbl_proyecto:id,nombre',
                'tbl_empleado:id,nombres,apellidos',
                'tbl_solicitud_compra_detalles.tbl_material:id,nombre,unidad_medida'
            ])->findOrFail($id);

            $dto = new MessageDTO(true, "Solicitud de compra obtenida correctamente", 200, $solicitud);

            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, "Solicitud de compra no encontrada", 404, null);
            return new ApiResponseResource($dto);
        }
    }
}
