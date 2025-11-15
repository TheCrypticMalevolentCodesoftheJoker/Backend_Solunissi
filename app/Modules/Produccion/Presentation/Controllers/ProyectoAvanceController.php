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
            $avances = TblProyectoAvance::with([
                'tbl_proyecto:id,nombre,fecha_inicio,fecha_fin'
            ])
                ->orderBy('fecha_registro', 'desc')
                ->get();

            $dto = new MessageDTO(
                true,
                "Listado de avances de proyectos obtenido correctamente",
                200,
                $avances
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
            $proyecto = TblProyecto::findOrFail($request->proyecto_id);

            $fechaInicio = Carbon::parse($proyecto->fecha_inicio);
            $fechaFin = Carbon::parse($proyecto->fecha_fin);
            $hoy = Carbon::now();

            $diasTotales = $fechaInicio->diffInDays($fechaFin);
            $diasTranscurridos = $fechaInicio->diffInDays($hoy);

            $porcentajePlanificado = $diasTotales > 0
                ? min(($diasTranscurridos / $diasTotales) * 100, 100)
                : 0;

            $porcentajeReal = $request->porcentaje_avance;
            if ($porcentajeReal > $porcentajePlanificado) {
                $estado = 'Adelantado';
            } elseif ($porcentajeReal < $porcentajePlanificado) {
                $estado = 'Retrasado';
            } else {
                $estado = 'Optimo';
            }

            $avance = TblProyectoAvance::create([
                'proyecto_id'       => $request->proyecto_id,
                'titulo'            => $request->titulo,
                'descripcion'       => $request->descripcion,
                'fecha_registro'    => now(),
                'porcentaje_avance' => $porcentajeReal,
                'estado'            => $estado,
            ]);

            DB::commit();

            $dto = new MessageDTO(true, "Avance del proyecto registrado correctamente. Estado: {$estado}", 201, $avance->load('tbl_proyecto:id,nombre,fecha_inicio,fecha_fin'));
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
            $avance = TblProyectoAvance::with([
                'tbl_proyecto:id,nombre,fecha_inicio,fecha_fin'
            ])->findOrFail($id);

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
}
