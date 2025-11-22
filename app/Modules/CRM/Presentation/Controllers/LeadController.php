<?php

namespace Modules\CRM\Presentation\Controllers;

use App\Models\TblLead;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class LeadController extends Controller
{
    public function index()
    {
        try {
            $leads = TblLead::all();

            if ($leads->isEmpty()) {
                $dto = new MessageDTO(true, 'No hay leads registrados', 200, []);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, 'Leads registrados', 200, $leads);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, 'Error al obtener leads: ' . $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $lead = TblLead::create([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'empresa' => $request->empresa,
                'correo' => $request->correo,
                'telefono' => $request->telefono,
                'fuente' => $request->fuente,
                'estado' => 'nuevo',
            ]);

            DB::commit();

            $dto = new MessageDTO(true, 'Lead registrado correctamente', 201, $lead);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            DB::rollBack();

            $dto = new MessageDTO(false, 'Error al registrar lead: ' . $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }

    public function show($id)
    {
        try {
            $lead = TblLead::find($id);

            if (!$lead) {
                $dto = new MessageDTO(false, 'Lead no encontrado', 404, null);
            } else {
                $dto = new MessageDTO(true, 'Detalle de lead', 200, $lead);
            }

            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, 'Error al buscar lead: ' . $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }
}
