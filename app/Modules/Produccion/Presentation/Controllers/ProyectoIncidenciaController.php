<?php

namespace Modules\Produccion\Presentation\Controllers;

use App\Models\TblProyectoIncidenciaDetalle;
use App\Models\TblProyectoIncidencium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class ProyectoIncidenciaController extends Controller
{
    public function index()
    {
        try {
            $incidencias = TblProyectoIncidencium::with([
                'tbl_proyecto',
                'tbl_proyecto_incidencia_detalles',
                'tbl_proyecto_incidencia_detalles.tbl_material'
            ])
                ->orderBy('fecha_reporte', 'desc')
                ->get();

            if ($incidencias->isEmpty()) {
                return new ApiResponseResource(
                    new MessageDTO(false, "No existen incidencias registradas.", 404, null)
                );
            }

            return new ApiResponseResource(
                new MessageDTO(true, "Lista de incidencias obtenida correctamente", 200, $incidencias)
            );
        } catch (\Exception $e) {

            return new ApiResponseResource(
                new MessageDTO(false, "Error: " . $e->getMessage(), 500, null)
            );
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $incidencia = TblProyectoIncidencium::create([
                'proyecto_id'   => $request->proyecto_id,
                'descripcion'   => $request->descripcion,
                'fecha_reporte' => now(),
                'estado'        => 'Pendiente',
            ]);

            $registrados = [];

            if (!empty($request->materiales)) {
                foreach ($request->materiales as $m) {
                    $registrados[] = TblProyectoIncidenciaDetalle::create([
                        'incidencia_id' => $incidencia->id,
                        'material_id'   => $m['material_id'],
                        'cantidad'      => $m['cantidad'],
                    ]);
                }
            }

            DB::commit();

            $dto = new MessageDTO(
                true,
                "Incidencia registrada correctamente",
                201,
                null
            );

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

            $incidencia = TblProyectoIncidencium::with([
                'tbl_proyecto',
                'tbl_proyecto_incidencia_detalles',
                'tbl_proyecto_incidencia_detalles.tbl_material'
            ])->find($id);

            if (!$incidencia) {
                return new ApiResponseResource(
                    new MessageDTO(
                        false,
                        "No se encontró la incidencia solicitada",
                        404,
                        null
                    )
                );
            }

            if ($incidencia->tbl_proyecto_incidencia_detalles->isEmpty()) {
                return new ApiResponseResource(
                    new MessageDTO(
                        true,
                        "Incidencia encontrada, pero no tiene detalles registrados",
                        200,
                        $incidencia
                    )
                );
            }

            return new ApiResponseResource(
                new MessageDTO(
                    true,
                    "Detalle de la incidencia obtenido correctamente",
                    200,
                    $incidencia
                )
            );
        } catch (\Exception $e) {

            return new ApiResponseResource(
                new MessageDTO(
                    false,
                    "Error interno: " . $e->getMessage(),
                    500,
                    null
                )
            );
        }
    }


    public function showGetByIdProyecto($proyectoId)
    {
        try {
            $incidencias = TblProyectoIncidencium::with([
                'tbl_proyecto',
                'tbl_proyecto_incidencia_detalles',
                'tbl_proyecto_incidencia_detalles.tbl_material'
            ])
                ->where('proyecto_id', $proyectoId)
                ->orderBy('fecha_reporte', 'desc')
                ->get();
            if ($incidencias->isEmpty()) {
                return new ApiResponseResource(
                    new MessageDTO(
                        true,
                        "No se encontraron incidencias registradas para este proyecto",
                        200,
                        null
                    )
                );
            }

            return new ApiResponseResource(
                new MessageDTO(
                    true,
                    "Listado de incidencias del proyecto obtenido correctamente",
                    200,
                    $incidencias
                )
            );
        } catch (\Exception $e) {

            return new ApiResponseResource(
                new MessageDTO(
                    false,
                    "Error al obtener incidencias del proyecto: " . $e->getMessage(),
                    500,
                    null
                )
            );
        }
    }
}
