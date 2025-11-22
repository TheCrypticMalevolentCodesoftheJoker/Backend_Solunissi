<?php

namespace Modules\RRHH\Presentation\Controllers;

use App\Models\TblAsistenciaDetalle;
use App\Models\TblAsistencium;
use Illuminate\Http\Request;
use App\Models\TblEmpleado;
use App\Models\TblEquipoOperativo;
use App\Models\TblEquipoOperativoDetalle;
use App\Models\TblNomina;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class EmpleadoController extends Controller
{
    public function index()
    {
        try {
            $empleados = TblEmpleado::with('tbl_cargo')->orderBy('id')->get();

            if ($empleados->isEmpty()) {
                return new ApiResponseResource(
                    new MessageDTO(true, "No existen empleados registrados", 204, null)
                );
            }

            return new ApiResponseResource(
                new MessageDTO(true, "Empleados obtenidos correctamente", 200, $empleados)
            );
        } catch (\Exception $e) {
            return new ApiResponseResource(
                new MessageDTO(false, $e->getMessage() ?: "Error al obtener empleados", $e->getCode() ?: 500, null)
            );
        }
    }

    public function indexVendedores()
    {
        try {
            $vendedores = TblEmpleado::with('tbl_cargo')
                ->where('cargo_id', 4)
                ->orderBy('id')
                ->get();

            if ($vendedores->isEmpty()) {
                return new ApiResponseResource(
                    new MessageDTO(true, "No existen vendedores registrados", 204, null)
                );
            }

            return new ApiResponseResource(
                new MessageDTO(true, "Vendedores obtenidos correctamente", 200, $vendedores)
            );
        } catch (\Exception $e) {
            return new ApiResponseResource(
                new MessageDTO(false, $e->getMessage() ?: "Error al obtener vendedores", $e->getCode() ?: 500, null)
            );
        }
    }


    public function store(Request $request)
    {
        try {
            $empleadoData = TblEmpleado::create($request->all());
            $dto = new MessageDTO(true, "Empleado {$empleadoData->nombres} registrado correctamente", 201, null);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $code = $e->getCode() ?: 500;
            $mensaje = $e->getMessage() ?: "Error al registrar empleado";

            $dto = new MessageDTO(false, $mensaje, $code, null);
            return new ApiResponseResource($dto);
        }
    }

    public function asignarEquipoOperativo(Request $request)
    { {
            DB::beginTransaction();

            try {
                $equipo = TblEquipoOperativo::create([
                    'nombre' => $request->input('nombre'),
                    'proyecto_id' => $request->input('proyecto_id'),
                ]);

                $empleadoIds = $request->input('empleado_ids', []);
                foreach ($empleadoIds as $empleadoId) {
                    TblEquipoOperativoDetalle::create([
                        'equipo_operativo_id' => $equipo->id,
                        'empleado_id' => $empleadoId,
                    ]);
                }

                DB::commit();

                $dto = new MessageDTO(true, "Equipo operativo '{$equipo->nombre}' creado y empleados asignados correctamente", 201, $equipo);
                return new ApiResponseResource($dto);
            } catch (\Exception $e) {
                DB::rollBack();

                $dto = new MessageDTO(false, $e->getMessage(), $e->getCode() ?: 500, null);
                return new ApiResponseResource($dto);
            }
        }
    }

    public function consultarEquipoOperativo()
    {
        try {
            $equipos = TblEquipoOperativo::with([
                'tbl_equipo_operativo_detalles.tbl_empleado',
                'tbl_proyecto:id,nombre'
            ])
                ->orderBy('id')
                ->get();

            if ($equipos->isEmpty()) {
                $dto = new MessageDTO(true, "No existen equipos operativos registrados", 204, null);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, "Equipos operativos obtenidos correctamente", 200, $equipos);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $code = $e->getCode() ?: 500;
            $mensaje = $e->getMessage() ?: "Error al obtener equipos operativos";

            $dto = new MessageDTO(false, $mensaje, $code, null);
            return new ApiResponseResource($dto);
        }
    }

    public function registrarAsistencia(Request $request)
    {
        DB::beginTransaction();

        try {
            $asistencia = TblAsistencium::create([
                'equipo_operativo_id' => $request->input('equipo_operativo_id'),
                'proyecto_id' => $request->input('proyecto_id'),
                'supervisor_id' => $request->input('supervisor_id'),
                'fecha' => $request->input('fecha', now()->toDateString()),
            ]);

            $detalles = $request->input('detalles', []);

            foreach ($detalles as $detalle) {
                TblAsistenciaDetalle::create([
                    'asistencia_id' => $asistencia->id,
                    'empleado_id' => $detalle['empleado_id'],
                    'estado' => $detalle['estado'],
                    'horas_extra' => $detalle['horas_extra'] ?? 0,
                    'observacion' => $detalle['observacion'] ?? null,
                ]);
            }

            DB::commit();

            $dto = new MessageDTO(true, "Asistencia registrada correctamente", 201, $asistencia);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            DB::rollBack();

            $code = $e->getCode() ?: 500;
            $mensaje = $e->getMessage() ?: "Error al registrar asistencia";

            $dto = new MessageDTO(false, $mensaje, $code, null);
            return new ApiResponseResource($dto);
        }
    }

    public function consultarAsistencia()
    {
        try {
            $asistencias = TblAsistencium::with([
                'tbl_proyecto:id,nombre',
                'tbl_equipo_operativo:id,nombre',
                'tbl_asistencia_detalles.tbl_empleado:id,dni,nombres,apellidos'
            ])
                ->orderBy('fecha', 'desc')
                ->get();

            if ($asistencias->isEmpty()) {
                $dto = new MessageDTO(false, "No se encontró ningún registro de asistencia", 404, []);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, "Asistencias consultadas correctamente", 200, $asistencias);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, $e->getMessage(), $e->getCode() ?: 500, null);
            return new ApiResponseResource($dto);
        }
    }
}
