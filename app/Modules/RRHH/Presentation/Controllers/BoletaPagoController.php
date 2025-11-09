<?php

namespace Modules\RRHH\Presentation\Controllers;

use App\Models\TblAsistenciaDetalle;
use App\Models\TblBoletaPago;
use App\Models\TblEmpleado;
use Illuminate\Http\Request;
use App\Models\TblNomina;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class BoletaPagoController extends Controller
{
    public function index()
    {
        try {
            $boletas = TblBoletaPago::with([
                'tbl_empleado.tbl_cargo',
                'tbl_nomina'
            ])
                ->orderBy('id', 'desc')
                ->get();

            if ($boletas->isEmpty()) {
                $dto = new MessageDTO(false, "No se encontraron boletas de pago registradas", 404, []);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, "Boletas de pago listadas correctamente", 200, $boletas);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, $e->getMessage(), $e->getCode() ?: 500, null);
            return new ApiResponseResource($dto);
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $nominaId = $request->input('nomina_id');
            $empleadoId = $request->input('empleado_id');

            $nomina = TblNomina::findOrFail($nominaId);
            $empleado = TblEmpleado::with('tbl_cargo')->findOrFail($empleadoId);
            $salarioBase = $empleado->tbl_cargo->salario_base ?? 0;

            $totalHorasExtra = TblAsistenciaDetalle::where('empleado_id', $empleadoId)
                ->whereHas('tbl_asistencium', function ($q) use ($nomina) {
                    $q->whereBetween('fecha', [$nomina->fecha_inicio, $nomina->fecha_fin]);
                })
                ->sum('horas_extra');

            $valorHoraExtra = 10;
            $montoHorasExtra = $totalHorasExtra * $valorHoraExtra;

            $bonos = $request->input('bonos', 0);
            $descuentos = $request->input('descuentos', 0);

            $netoPagar = $salarioBase + $montoHorasExtra + $bonos - $descuentos;

            $boleta = TblBoletaPago::create([
                'nomina_id'    => $nominaId,
                'empleado_id'  => $empleadoId,
                'salario_base' => $salarioBase,
                'horas_extra'  => $montoHorasExtra,
                'bonos'        => $bonos,
                'descuentos'   => $descuentos,
                'neto_pagar'   => $netoPagar,
                'estado'       => 'Pendiente',
            ]);

            $codigo = 'BP' . str_pad($boleta->id, 6, '0', STR_PAD_LEFT);
            $boleta->codigo = $codigo;
            $boleta->save();

            $totalNomina = TblBoletaPago::where('nomina_id', $nominaId)->sum('neto_pagar');
            TblNomina::where('id', $nominaId)->update(['total_nomina' => $totalNomina]);

            DB::commit();

            $dto = new MessageDTO(true, "Boleta registrada correctamente", 201, $boleta);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            DB::rollBack();
            $code = (int)$e->getCode();
            if ($code === 0) {
                $code = 500;
            }

            $dto = new MessageDTO(false, $e->getMessage(), $code, null);
            return new ApiResponseResource($dto);
        }
    }
}
