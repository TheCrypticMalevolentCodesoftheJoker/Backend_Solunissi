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
                'tbl_proyecto:id,nombre',
                'tbl_empleado:id,nombres,apellidos',
                'tbl_proyecto_incidencia_detalles.tbl_material:id,nombre,unidad_medida'
            ])->get();

            $dto = new MessageDTO(
                true,
                "Lista de incidencias obtenida correctamente",
                200,
                $incidencias
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
            $incidencia = TblProyectoIncidencium::create([
                'proyecto_id'   => $request->proyecto_id,
                'supervisor_id' => $request->supervisor_id,
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
                $incidencia->load([
                    'tbl_proyecto:id,nombre',
                    'tbl_empleado:id,nombres,apellidos',
                    'tbl_proyecto_incidencia_detalles.tbl_material:id,nombre,unidad_medida'
                ])
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
                'tbl_proyecto:id,nombre',
                'tbl_empleado:id,nombres,apellidos',
                'tbl_proyecto_incidencia_detalles.tbl_material:id,nombre,unidad_medida'
            ])->findOrFail($id);

            $dto = new MessageDTO(
                true,
                "Incidencia obtenida correctamente",
                200,
                $incidencia
            );

            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, $e->getMessage(), 404, null);
            return new ApiResponseResource($dto);
        }
    }
}
