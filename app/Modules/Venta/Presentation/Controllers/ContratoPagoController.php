<?php

namespace Modules\Venta\Presentation\Controllers;

use App\Models\TblContratoPago;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TblProyecto;
use App\Models\TblTransaccionContable;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class ContratoPagoController extends Controller
{
    public function index()
    {
        try {
            $pagos = TblContratoPago::with('tbl_contrato')
                ->orderBy('id', 'desc')
                ->get();

            if ($pagos->isEmpty()) {
                $dto = new MessageDTO(true, 'No hay pagos registrados aún', 200, []);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, 'Lista de pagos de contratos', 200, $pagos);
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
            $pago = TblContratoPago::create([
                'codigo' => 'PAG-' . str_pad(TblContratoPago::max('id') + 1, 5, '0', STR_PAD_LEFT),
                'contrato_id' => $request->contrato_id,
                'monto' => $request->monto,
                'fecha_pago' => $request->fecha_pago,
                'medio_pago' => $request->medio_pago,
                'estado' => 'Registrado',
            ]);
            $proyecto_id = TblProyecto::where('contrato_id', $request->contrato_id)->value('id');
            $asiento = TblTransaccionContable::create([
                'fecha_registro' => $pago->fecha_pago,
                'proyecto_id' => $proyecto_id,
                'tipo_transaccion_contable_id' => 1,
                'centro_costo_id' => 6,
                'monto_total' => $request->monto,
                'modulo_origen' => 'Venta',
                'referencia_id' => $pago->codigo,
                'descripcion' => "Anticipo del contrato {$pago->contrato_id}, código {$pago->codigo}",
                'estado' => 'Pendiente',
            ]);

            DB::commit();

            $dto = new MessageDTO(true, 'Anticipo registrado y asiento contable generado', 201, null);

            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            DB::rollBack();
            $dto = new MessageDTO(false, $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }
    // depende de contrato(venta)

    public function show($id)
    {
        try {
            $pago = TblContratoPago::with('tbl_contrato')
                ->find($id);

            if (!$pago) {
                $dto = new MessageDTO(false, 'Pago no encontrado', 404, null);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, 'Detalle del pago', 200, $pago);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }
}
