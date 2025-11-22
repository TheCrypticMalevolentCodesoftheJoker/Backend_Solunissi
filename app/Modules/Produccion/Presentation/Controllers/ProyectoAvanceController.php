<?php

namespace Modules\Produccion\Presentation\Controllers;

use App\Models\TblProyecto;
use App\Models\TblProyectoAvance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class ProyectoAvanceController extends Controller
{
    public function index()
    {
        try {
            $avances = TblProyectoAvance::with(['tbl_proyecto'])
                ->orderBy('fecha_registro', 'desc')
                ->get();

            if ($avances->isEmpty()) {
                $dto = new MessageDTO(true, "No existen avances registrados", 200, null);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, "Listado de avances de proyectos obtenido correctamente", 200, $avances);

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

            $proyecto = TblProyecto::findOrFail($request->proyecto_id);
            if ($proyecto->estado === 'Pendiente de cierre') {
                return new ApiResponseResource(
                    new MessageDTO(false, "Este proyecto ya está pendiente de cierre. No se pueden registrar más avances.", 400, null)
                );
            }

            $fechaInicio = Carbon::parse($proyecto->fecha_inicio);
            $fechaFin    = Carbon::parse($proyecto->fecha_fin);
            $hoy         = Carbon::now();

            $diasTotales       = $fechaInicio->diffInDays($fechaFin);
            $diasTranscurridos = $fechaInicio->diffInDays(min($fechaFin, $hoy));

            $porcentajePlanificado = $diasTotales > 0
                ? min(($diasTranscurridos / $diasTotales) * 100, 100)
                : 0;

            $porcentajeReal = $request->porcentaje_avance;

            if ($porcentajeReal == 100) {
                $estadoAvance = "Culminado";
            } else {
                if ($porcentajeReal > $porcentajePlanificado) {
                    $estadoAvance = 'Adelantado';
                } elseif ($porcentajeReal < $porcentajePlanificado) {
                    $estadoAvance = 'Retrasado';
                } else {
                    $estadoAvance = 'Óptimo';
                }
            }

            $avance = TblProyectoAvance::create([
                'proyecto_id'       => $proyecto->id,
                'titulo'            => $request->titulo,
                'descripcion'       => $request->descripcion,
                'fecha_registro'    => now(),
                'porcentaje_avance' => $porcentajeReal,
                'estado'            => $estadoAvance,
            ]);

            if ($porcentajeReal == 100) {
                $proyecto->estado = 'Pendiente de cierre';
            } else {
                $proyecto->estado = 'En curso';
            }

            $proyecto->save();

            DB::commit();

            return new ApiResponseResource(
                new MessageDTO(true, "Avance registrado correctamente. Estado del avance: {$estadoAvance}", 201, null)
            );
        } catch (\Exception $e) {

            DB::rollBack();

            return new ApiResponseResource(
                new MessageDTO(false, "Error al registrar el avance: " . $e->getMessage(), 500, null)
            );
        }
    }

    public function show($id)
    {
        try {
            $avance = TblProyectoAvance::with(['tbl_proyecto'])
                ->find($id);

            if (!$avance) {
                $dto = new MessageDTO(
                    false,
                    "El avance solicitado no existe",
                    404,
                    null
                );
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(
                true,
                "Detalle del avance obtenido correctamente",
                200,
                $avance
            );

            return new ApiResponseResource($dto);
        } catch (\Exception $e) {

            $dto = new MessageDTO(false, $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }

    public function showGetByIdProyecto($proyectoId)
    {
        try {
            $proyecto = TblProyecto::find($proyectoId);

            if (!$proyecto) {
                $dto = new MessageDTO(
                    false,
                    "El proyecto solicitado no existe",
                    404,
                    null
                );
                return new ApiResponseResource($dto);
            }
            $avances = TblProyectoAvance::with(['tbl_proyecto'])
                ->where('proyecto_id', $proyectoId)
                ->orderBy('fecha_registro', 'desc')
                ->get();

            if ($avances->isEmpty()) {
                $dto = new MessageDTO(
                    true,
                    "El proyecto no tiene avances registrados",
                    200,
                    null
                );
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(
                true,
                "Listado de avances del proyecto obtenido correctamente",
                200,
                $avances
            );

            return new ApiResponseResource($dto);
        } catch (\Exception $e) {

            $dto = new MessageDTO(false, $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }
}
