<?php

namespace Modules\Venta\Presentation\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TblContrato;
use App\Models\TblProyecto;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class ContratoController extends Controller
{
    public function index()
    {
        try {
            $contratos = TblContrato::with([
                'tbl_cliente.tbl_lead',
                'tbl_proyectos'
            ])
                ->orderBy('id', 'desc')
                ->get();

            if ($contratos->isEmpty()) {
                $dto = new MessageDTO(true, 'No hay contratos registrados', 200, []);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, 'Listado de contratos', 200, $contratos);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, 'Error al obtener contratos: ' . $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $contrato = TblContrato::create([
                'cliente_id' => $request->cliente_id,
                'codigo' => 'CT-' . str_pad(TblContrato::max('id') + 1, 5, '0', STR_PAD_LEFT),
                'tipo_servicio' => $request->tipo_servicio,
                'descripcion' => $request->descripcion,
                'fecha_firma' => $request->fecha_firma,
                'fecha_vencimiento' => $request->fecha_vencimiento,
                'monto_total' => $request->monto_total,
                'estado' => 'Activo',
            ]);
            $proyecto = TblProyecto::create([
                'contrato_id' => $contrato->id,
                'nombre' => 'PROY-' . str_pad(TblProyecto::max('id') + 1, 5, '0', STR_PAD_LEFT),
                'descripcion' => "Proyecto asociado al contrato {$contrato->codigo} para el servicio de {$contrato->tipo_servicio}, generado automáticamente desde el módulo de ventas.",
                'almacen_id' => null,
                'supervisor_id' => null,
                'fecha_inicio' => null,
                'fecha_fin' => null,
                'monto_asignado' => 0,
                'monto_ejecutado' => 0,
                'estado' => 'Programado',
            ]);

            DB::commit();

            $dto = new MessageDTO(true, 'Contrato registrado', 201, null);

            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            DB::rollBack();
            $dto = new MessageDTO(false, $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }
    // Depende del cliente(CRM)

    public function show($id)
    {
        try {
            $contrato = TblContrato::with([
                'tbl_cliente.tbl_lead',
                'tbl_proyectos'
            ])->find($id);

            if (!$contrato) {
                $dto = new MessageDTO(false, 'Contrato no encontrado', 404, null);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, 'Detalle del contrato', 200, $contrato);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, 'Error al obtener contrato: ' . $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }
}
