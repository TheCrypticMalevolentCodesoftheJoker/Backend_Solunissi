<?php

namespace Modules\RRHH\Presentation\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\TblNomina;
use App\Models\TblTransaccionContable;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class NominaController extends Controller
{
    public function index()
    {
        try {
            $nominas = TblNomina::orderBy('fecha_inicio', 'desc')->get();

            if ($nominas->isEmpty()) {
                $dto = new MessageDTO(false, "No se encontraron nóminas registradas", 404, []);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, "Listado de nóminas consultado correctamente", 200, $nominas);
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
            $nomina = TblNomina::create([
                'periodo'      => $request->input('periodo'),
                'fecha_inicio' => $request->input('fecha_inicio'),
                'fecha_fin'    => $request->input('fecha_fin'),
                'fecha_pago'   => $request->input('fecha_pago'),
                'total_nomina' => $request->input('total_nomina', 0),
                'estado'       => 'Borrador',
            ]);

            $yearMonth = date('Ym', strtotime($nomina->fecha_inicio));
            $codigo = 'NOM' . $yearMonth . str_pad($nomina->id, 3, '0', STR_PAD_LEFT);

            $nomina->codigo = $codigo;
            $nomina->save();

            DB::commit();

            $dto = new MessageDTO(true, "Nómina creada correctamente", 201, $nomina);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            DB::rollBack();

            $code = (int)$e->getCode();
            if ($code === 0) $code = 500;

            $dto = new MessageDTO(false, $e->getMessage(), $code, null);
            return new ApiResponseResource($dto);
        }
    }

    public function cerrarNomina($nominaId)
    {
        DB::beginTransaction();
        try {
            $nomina = TblNomina::findOrFail($nominaId);

            if ($nomina->estado === 'Cerrada') {
                throw new \Exception("La nómina ya está cerrada");
            }

            $nomina->estado = 'Cerrada';
            $nomina->save();

            // 4️⃣ Crear transacción contable
            $transaccion = TblTransaccionContable::create([
                'fecha_registro'            => now(),
                'proyecto_id'               => null,
                'tipo_transaccion_contable_id' => 4,
                'centro_costo_id'           => 5,
                'monto_total'               => $nomina->total_nomina,
                'modulo_origen'             => 'RRHH',
                'referencia_id'             => $nomina->codigo,
                'descripcion'               => "Cierre de nómina id {$nomina->id} - Pago de personal",
                'estado'                    => 'Pendiente',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Nómina cerrada y transacción contable creada correctamente',
                'data'    => $transaccion
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'code'    => (int)$e->getCode() ?: 500,
                'data'    => null
            ], 500);
        }
    }

    public function reportePDF($nominaId)
    {
        try {
            $nomina = DB::table('tbl_nomina')->where('id', $nominaId)->first();
            if (!$nomina) {
                throw new \Exception("Nómina no encontrada", 404);
            }

            $boletas = DB::table('tbl_boleta_pago as b')
                ->join('tbl_empleado as e', 'b.empleado_id', '=', 'e.id')
                ->join('tbl_cargo as c', 'e.cargo_id', '=', 'c.id')
                ->leftJoin('tbl_equipo_operativo_detalle as ed', 'e.id', '=', 'ed.empleado_id')
                ->leftJoin('tbl_equipo_operativo as eo', 'ed.equipo_operativo_id', '=', 'eo.id')
                ->select(
                    'b.codigo as boleta_codigo',
                    'e.nombres',
                    'e.apellidos',
                    'c.nombre as cargo',
                    DB::raw('COALESCE(eo.nombre, "N/A") as equipo_operativo'),
                    'b.salario_base',
                    'b.horas_extra',
                    'b.bonos',
                    'b.descuentos',
                    'b.neto_pagar'
                )
                ->where('b.nomina_id', $nominaId)
                ->get();

            $totalNeto = $boletas->sum('neto_pagar');

            $html = '<html><head><style>
            body { font-family: sans-serif; font-size: 12px; }
            h2 { text-align:center; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th, td { border: 1px solid #000; padding: 6px; text-align: left; }
            th { background-color: #f2f2f2; }
            </style></head><body>';

            $html .= "<h2>Reporte de Nómina</h2>";
            $html .= "<p><strong>Nómina:</strong> {$nomina->codigo} - <strong>Periodo:</strong> {$nomina->periodo}</p>";

            $html .= "<table>";
            $html .= "<thead><tr>
            <th>Boleta</th>
            <th>Empleado</th>
            <th>Cargo</th>
            <th>Equipo Operativo</th>
            <th>Salario Base</th>
            <th>Horas Extra</th>
            <th>Bonos</th>
            <th>Descuentos</th>
            <th>Neto a Pagar</th>
            </tr></thead><tbody>";

            foreach ($boletas as $b) {
                $html .= "<tr>
                <td>{$b->boleta_codigo}</td>
                <td>{$b->nombres} {$b->apellidos}</td>
                <td>{$b->cargo}</td>
                <td>{$b->equipo_operativo}</td>
                <td>{$b->salario_base}</td>
                <td>{$b->horas_extra}</td>
                <td>{$b->bonos}</td>
                <td>{$b->descuentos}</td>
                <td>{$b->neto_pagar}</td>
            </tr>";
            }

            $html .= "<tr>
            <td colspan='8' style='text-align:right'><strong>Total Nómina:</strong></td>
            <td><strong>{$totalNeto}</strong></td>
        </tr>";

            $html .= "</tbody></table></body></html>";

            $pdf = Pdf::loadHTML($html);

            return $pdf->download('reporte_nomina_' . $nomina->codigo . '.pdf');
        } catch (\Exception $e) {
            $code = (int) $e->getCode();
            if ($code === 0) $code = 500;
            $mensaje = $e->getMessage() ?: "Error al generar PDF";
            $messageDTO = new MessageDTO(false, $mensaje, $code, null);
            return new ApiResponseResource($messageDTO);
        }
    }
}
