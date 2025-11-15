<?php

namespace Modules\CRM\Presentation\Controllers;

use App\Models\TblCliente;
use App\Models\TblLead;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class ClienteController extends Controller
{
    public function index()
    {
        try {
            $clientes = TblCliente::with('tbl_lead')->get();

            if ($clientes->isEmpty()) {
                $dto = new MessageDTO(true, 'No hay clientes registrados', 200, []);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, 'Listado de clientes', 200, $clientes);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, 'Error al obtener clientes: ' . $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $cliente = TblCliente::create([
                'lead_id'        => $request->lead_id,
                'ruc'            => $request->ruc,
                'razon_social'   => $request->razon_social,
                'tipo_cliente'   => $request->tipo_cliente,

                'direccion'      => $request->direccion,
                'pais'           => $request->pais,
                'departamento'   => $request->departamento,
                'provincia'      => $request->provincia,
                'distrito'       => $request->distrito,

                'web'            => $request->web,
                'sector'         => $request->sector,
                'referencia'     => $request->referencia,
                'cargo_contacto' => $request->cargo_contacto,
                'area_contacto'  => $request->area_contacto,

                'linkedin'       => $request->linkedin,
                'facebook'       => $request->facebook,
                'twitter'        => $request->twitter,
                'instagram'      => $request->instagram,
                'estado'         => 'Activo',
            ]);

            if ($request->lead_id) {
                $lead = TblLead::find($request->lead_id);
                if ($lead) {
                    $lead->estado = 'convertido';
                    $lead->save();
                }
            }

            DB::commit();

            $dto = new MessageDTO(true, 'Cliente registrado correctamente', 201, $cliente);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            DB::rollBack();

            $dto = new MessageDTO(false, 'Error al registrar cliente: ' . $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }

    public function show($id)
    {
        try {
            $cliente = TblCliente::with('tbl_lead')->find($id);

            if (!$cliente) {
                $dto = new MessageDTO(false, 'Cliente no encontrado', 404, null);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, 'Detalle del cliente', 200, $cliente);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, 'Error al obtener cliente: ' . $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }
}
