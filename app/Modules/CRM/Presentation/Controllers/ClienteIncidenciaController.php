<?php

namespace Modules\CRM\Presentation\Controllers;

use App\Models\TblClienteIncidencium;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class ClienteIncidenciaController extends Controller
{
    public function index()
    {
        try {
            $incidencias = TblClienteIncidencium::with('tbl_cliente.tbl_lead')
                ->orderBy('fecha', 'desc')
                ->get();

            if ($incidencias->isEmpty()) {
                $dto = new MessageDTO(true, 'No hay incidencias registradas', 200, []);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, 'Listado de incidencias', 200, $incidencias);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, 'Error al obtener incidencias: ' . $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $incidencia = TblClienteIncidencium::create([
                'cliente_id' => $request->cliente_id,
                'fecha'      => $request->fecha,
                'tipo'       => $request->tipo,
                'asunto'     => $request->asunto,
                'detalle'    => $request->detalle,
                'prioridad'  => $request->prioridad,
                'estado'     => 'Pendiente',
            ]);

            DB::commit();

            $dto = new MessageDTO(true, 'Incidencia registrada correctamente', 201, $incidencia);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            DB::rollBack();

            $dto = new MessageDTO(false, 'Error al registrar incidencia: ' . $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }
    
    public function show($id)
    {
        try {
            $incidencia = TblClienteIncidencium::with('tbl_cliente.tbl_lead')
                ->find($id);

            if (!$incidencia) {
                $dto = new MessageDTO(false, 'Incidencia no encontrada', 404, null);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, 'Detalle de la incidencia', 200, $incidencia);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, 'Error al obtener incidencia: ' . $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }
}
