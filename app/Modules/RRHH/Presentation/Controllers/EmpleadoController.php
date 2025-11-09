<?php

namespace Modules\RRHH\Presentation\Controllers;

use Illuminate\Http\Request;
use App\Models\TblEmpleado;
use App\Models\TblEquipoOperativo;
use App\Models\TblEquipoOperativoDetalle;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class EmpleadoController extends Controller
{
    public function index()
    {
        try {
            $empleados = TblEmpleado::with('tbl_cargo:id,nombre,salario_base')
                ->select('id', 'cargo_id', 'dni', 'nombres', 'apellidos', 'email', 'telefono', 'direccion', 'fecha_ingreso', 'estado', 'created_at', 'updated_at')
                ->orderBy('id')
                ->get();


            if ($empleados->isEmpty()) {
                $dto = new MessageDTO(true, "No existen empleados registrados", 204, null);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, "Empleados obtenidos correctamente", 200, $empleados);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $code = $e->getCode() ?: 500;
            $mensaje = $e->getMessage() ?: "Error al obtener empleados";

            $dto = new MessageDTO(false, $mensaje, $code, null);
            return new ApiResponseResource($dto);
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

    
}
