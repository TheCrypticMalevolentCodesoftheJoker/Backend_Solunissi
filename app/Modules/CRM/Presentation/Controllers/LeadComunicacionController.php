<?php

namespace Modules\CRM\Presentation\Controllers;


use App\Models\TblLeadComunicacion;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class LeadComunicacionController extends Controller
{
    public function index()
    {
        try {
            $comunicaciones = TblLeadComunicacion::with(['tbl_lead', 'tbl_empleado'])->get();

            if ($comunicaciones->isEmpty()) {
                $dto = new MessageDTO(true, 'No hay comunicaciones registradas', 200, []);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, 'Listado de comunicaciones', 200, $comunicaciones);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, 'Error al obtener comunicaciones: ' . $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $comunicacion = TblLeadComunicacion::create([
                'vendedor_id' => $request->vendedor_id,
                'lead_id'     => $request->lead_id,
                'fecha'       => $request->fecha,
                'tipo'        => $request->tipo,
                'asunto'      => $request->asunto,
                'detalle'     => $request->detalle,
            ]);

            DB::commit();

            $dto = new MessageDTO(true, 'Comunicación registrada correctamente', 201, $comunicacion);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            DB::rollBack();

            $dto = new MessageDTO(false, 'Error al registrar comunicación: ' . $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }

    public function show($id)
    {
        try {
            $comunicacion = TblLeadComunicacion::with(['tbl_lead', 'tbl_empleado'])->find($id);

            if (!$comunicacion) {
                $dto = new MessageDTO(false, 'Comunicación no encontrada', 404, null);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, 'Detalle de la comunicación', 200, $comunicacion);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, 'Error al obtener la comunicación: ' . $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }
}
