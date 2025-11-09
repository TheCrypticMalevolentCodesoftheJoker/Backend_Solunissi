<?php

namespace Modules\Contabilidad\Presentation\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class TransaccionContableController extends Controller
{

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // Insertar la transacción principal
            $transaccionId = DB::table('tbl_transaccion_contable')->insertGetId([
                'fecha' => $request->fecha,
                'tipo' => $request->tipo,
                'descripcion' => $request->descripcion,
                'monto_total' => $request->monto_total,
                'proyecto_id' => $request->proyecto_id ?? null,
                'centro_costo_id' => $request->centro_costo_id ?? null,
                'estado' => 'pendiente',
            ]);

            // Validar que se haya insertado correctamente
            if (!$transaccionId) {
                throw new \Exception("No se pudo crear la transacción", 500);
            }

            // Insertar los detalles contables
            foreach ($request->detalles as $d) {
                $detalleId = DB::table('tbl_detalle_transaccion')->insert([
                    'transaccion_id' => $transaccionId,
                    'cuenta_id' => $d['cuenta_id'],
                    'debe' => $d['debe'],
                    'haber' => $d['haber'],
                ]);

                if (!$detalleId) {
                    throw new \Exception("No se pudo crear el detalle contable", 500);
                }
            }

            DB::commit();

            $payload = [
                'transaccion_id' => $transaccionId,
                'detalles' => $request->detalles,
            ];

            $messageDTO = new MessageDTO(true, "Transacción registrada correctamente", 200, $payload);
            return new ApiResponseResource($messageDTO);
        } catch (\Exception $e) {
            DB::rollBack(); // revierte todo si ocurre un error
            $code = $e->getCode() ?: 500;
            $mensaje = $e->getMessage() ?: "Error al registrar la transacción";

            $messageDTO = new MessageDTO(false, $mensaje, $code, null);
            return new ApiResponseResource($messageDTO);
        }
    }

    public function index(Request $request)
    {
        try {
            $proyectoId = $request->proyecto_id;
            if (!$proyectoId) {
                throw new \Exception("Proyecto no encontrado", 404);
            }

            $gastos = DB::table('tbl_transaccion_contable as t')
                ->join('tbl_detalle_transaccion as d', 't.id', '=', 'd.transaccion_id')
                ->join('tbl_cuenta_contable as c', 'd.cuenta_id', '=', 'c.id')
                ->where('t.proyecto_id', $proyectoId)
                ->select('t.*', 'd.debe', 'd.haber', 'c.nombre as cuenta')
                ->get();

            $messageDTO = new MessageDTO(true, "Gastos por proyecto obtenidos", 200, $gastos);
            return new ApiResponseResource($messageDTO);
        } catch (\Exception $e) {
            $code = $e->getCode() ?: 500;
            $mensaje = $e->getMessage() ?: "Error al obtener los gastos por proyecto";
            $messageDTO = new MessageDTO(false, $mensaje, $code, null);
            return new ApiResponseResource($messageDTO);
        }
    }

    public function reportePDF(Request $request)
    {
        try {
            $periodo = $request->periodo;
            $anio = $request->anio;
            $mes = $request->mes ?? null;

            if (!$periodo || !$anio) {
                throw new \Exception("Parámetros de periodo incompletos", 400);
            }

            // Consulta base
            $query = DB::table('tbl_transaccion_contable as t')
                ->join('tbl_detalle_transaccion as d', 't.id', '=', 'd.transaccion_id')
                ->join('tbl_cuenta_contable as c', 'd.cuenta_id', '=', 'c.id')
                ->select('c.tipo', DB::raw('SUM(d.debe) as total_debe'), DB::raw('SUM(d.haber) as total_haber'))
                ->whereYear('t.fecha', $anio);

            if ($periodo === 'mensual') {
                if (!$mes) {
                    throw new \Exception("Debe especificar el mes para el reporte mensual", 400);
                }
                $query->whereMonth('t.fecha', $mes);
            }

            $resultados = $query->groupBy('c.tipo')->get();

            // Armar consolidado
            $consolidado = ['activo' => 0, 'pasivo' => 0, 'patrimonio' => 0, 'ingresos' => 0, 'egresos' => 0];
            foreach ($resultados as $r) {
                switch ($r->tipo) {
                    case 'activo':
                        $consolidado['activo'] = $r->total_debe - $r->total_haber;
                        break;
                    case 'pasivo':
                        $consolidado['pasivo'] = $r->total_haber - $r->total_debe;
                        break;
                    case 'patrimonio':
                        $consolidado['patrimonio'] = $r->total_haber - $r->total_debe;
                        break;
                    case 'ingreso':
                        $consolidado['ingresos'] = $r->total_haber - $r->total_debe;
                        break;
                    case 'egreso':
                        $consolidado['egresos'] = $r->total_debe - $r->total_haber;
                        break;
                }
            }

            // Construir HTML dinámico para el PDF
            $html = '<html><head><style>
            body { font-family: sans-serif; } 
            table { width: 100%; border-collapse: collapse; margin-top: 20px; } 
            th, td { border: 1px solid #000; padding: 8px; text-align: left; } 
            th { background-color: #f2f2f2; }
        </style></head><body>';
            $html .= "<h2>Reporte Financiero Consolidado</h2>";
            $html .= "<p>Periodo: " . ucfirst($periodo) . " " . ($mes ? "Mes $mes" : "") . " - Año: $anio</p>";
            $html .= "<table>";
            $html .= "<tr><th>Cuenta</th><th>Total</th></tr>";
            foreach ($consolidado as $cuenta => $total) {
                $html .= "<tr><td>" . ucfirst($cuenta) . "</td><td>$total</td></tr>";
            }
            $html .= "</table></body></html>";

            // Generar PDF desde HTML
            $pdf = Pdf::loadHTML($html);

            // Descargar PDF
            return $pdf->download('reporte_consolidado_' . $anio . ($mes ? "_$mes" : "") . '.pdf');
        } catch (\Exception $e) {
            $code = $e->getCode() ?: 500;
            $mensaje = $e->getMessage() ?: "Error al generar PDF";
            $messageDTO = new MessageDTO(false, $mensaje, $code, null);
            return new ApiResponseResource($messageDTO);
        }
    }

}
