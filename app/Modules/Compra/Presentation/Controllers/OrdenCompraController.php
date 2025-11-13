<?php

namespace Modules\Compra\Presentation\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TblCotizacion;
use App\Models\TblOrdenCompra;
use App\Models\TblTransaccionContable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class OrdenCompraController extends Controller
{
    public function index()
    {
        try {
            $ordenes = TblOrdenCompra::with([
                'tbl_cotizacion:id,proveedor_id,proyecto_id,total,fecha_cotizacion,estado',
                'tbl_cotizacion.tbl_proveedor:id,razon_social,ruc,correo,telefono',
                'tbl_cotizacion.tbl_proyecto:id,nombre'
            ])
                ->orderBy('fecha_emision', 'desc')
                ->get();

            $dto = new MessageDTO(
                true,
                "Listado de órdenes de compra obtenido correctamente",
                200,
                $ordenes
            );

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
            $cotizacion = TblCotizacion::findOrFail($request->cotizacion_id);
            $orden = TblOrdenCompra::create([
                'codigo'        => null,
                'proyecto_id'   => $cotizacion->proyecto_id,
                'cotizacion_id' => $cotizacion->id,
                'fecha_emision' => now(),
                'estado'        => 'Pendiente',
                'total_orden_compra' => $cotizacion->total,
            ]);
            $orden->update([
                'codigo' => 'OC' . str_pad($orden->id, 4, '0', STR_PAD_LEFT)
            ]);

            DB::commit();
            $dto = new MessageDTO(
                true,
                "Orden de compra registrada correctamente",
                201,
                $orden->load('tbl_cotizacion.tbl_proveedor', 'tbl_cotizacion.tbl_proyecto')
            );

            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            DB::rollBack();

            $dto = new MessageDTO(false, $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }

    public function show($id)
    {
        try {
            $orden = TblOrdenCompra::with([
                'tbl_cotizacion:id,proveedor_id,proyecto_id,total,fecha_cotizacion,estado',
                'tbl_cotizacion.tbl_proveedor:id,razon_social,ruc,correo,telefono',
                'tbl_cotizacion.tbl_proyecto:id,nombre',
                'tbl_cotizacion.tbl_cotizacion_detalles.tbl_material:id,nombre,unidad_medida'
            ])->findOrFail($id);

            $dto = new MessageDTO(
                true,
                "Orden de compra obtenida correctamente",
                200,
                $orden
            );

            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, "Orden de compra no encontrada", 404, null);
            return new ApiResponseResource($dto);
        }
    }

    public function aprobarOrdenCompra($ordenId)
    {
        DB::beginTransaction();

        try {
            $orden = TblOrdenCompra::findOrFail($ordenId);

            if ($orden->estado === 'Aprobada') {
                throw new \Exception("La orden de compra ya está aprobada");
            }

            $orden->estado = 'Aprobada';
            $orden->save();

            $transaccion = TblTransaccionContable::create([
                'fecha_registro'               => now(),
                'proyecto_id'                  => $orden->proyecto_id ?? null,
                'tipo_transaccion_contable_id' => 4,
                'centro_costo_id'              => 1,
                'monto_total'                  => $orden->total_orden_compra,
                'modulo_origen'                => 'COMPRAS',
                'referencia_id'                => $orden->codigo,
                'descripcion'                  => "Aprobación de orden de compra {$orden->codigo}",
                'estado'                       => 'Pendiente',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Orden de compra aprobada y asiento contable creado correctamente',
                'data'    => $transaccion,
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'code'    => (int) $e->getCode() ?: 500,
                'data'    => null
            ], 500);
        }
    }

    public function reportePDF(int $ordenId)
    {
        try {
            /** @var TblOrdenCompra $orden */
            $orden = TblOrdenCompra::with([
                'tbl_proyecto',
                'tbl_cotizacion.tbl_proveedor',
                'tbl_cotizacion.tbl_cotizacion_detalles.tbl_material'
            ])->findOrFail($ordenId);

            $html = '<html><head><style>
            body { font-family: sans-serif; font-size: 12px; }
            h2, h3 { text-align:center; }
            table { width: 100%; border-collapse: collapse; margin-top: 10px; }
            th, td { border: 1px solid #000; padding: 6px; text-align: left; }
            th { background-color: #f2f2f2; }
        </style></head><body>';

            $html .= "<h2>Orden de Compra</h2>";
            $html .= "<p><strong>Código:</strong> {$orden->codigo}</p>";
            $html .= "<p><strong>Proyecto:</strong> {$orden->tbl_proyecto?->nombre}</p>";
            $html .= "<p><strong>Fecha de Emisión:</strong> {$orden->fecha_emision?->format('d/m/Y')}</p>";
            $html .= "<p><strong>Estado:</strong> {$orden->estado}</p>";

            /** @var TblCotizacion|null $cotizacion */
            $cotizacion = $orden->tbl_cotizacion;

            if ($cotizacion) {
                $html .= "<h3>Cotización</h3>";
                $html .= "<p><strong>Proveedor:</strong> {$cotizacion->tbl_proveedor?->razon_social}</p>";
                $html .= "<p><strong>Fecha Cotización:</strong> {$cotizacion->fecha_cotizacion?->format('d/m/Y')}</p>";

                $html .= "<table>";
                $html .= "<thead><tr>
                <th>Material</th>
                <th>Unidad</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr></thead><tbody>";
            
                $detalles = $cotizacion->tbl_cotizacion_detalles;

                $subtotalMateriales = 0;
                foreach ($detalles as $detalle) {
                    /** @var TblCotizacionDetalle $detalle */
                    /** @var TblMaterial|null $materialObj */
                    $materialObj = $detalle->tbl_material;

                    $material = $materialObj?->nombre ?? 'N/A';
                    $unidad = $materialObj?->unidad_medida ?? $detalle->unidad_medida ?? 'N/A';
                    $cantidad = number_format((float)$detalle->cantidad, 2);
                    $precioUnitario = number_format((float)$detalle->precio_unitario, 2);
                    $subtotal = (float)$detalle->subtotal;

                    $subtotalMateriales += $subtotal;

                    $html .= "<tr>
                    <td>{$material}</td>
                    <td>{$unidad}</td>
                    <td>{$cantidad}</td>
                    <td>{$precioUnitario}</td>
                    <td>" . number_format($subtotal, 2) . "</td>
                </tr>";
                }

                $html .= "<tr>
                <td colspan='4' style='text-align:right'><strong>Subtotal Materiales:</strong></td>
                <td><strong>" . number_format($subtotalMateriales, 2) . "</strong></td>
            </tr>";

                $costoEnvio = (float)($cotizacion->costo_envio ?? 0);
                $descuento = (float)($cotizacion->descuento ?? 0);

                $html .= "<tr>
                <td colspan='4' style='text-align:right'><strong>Costo Envío/Pasaje:</strong></td>
                <td><strong>" . number_format($costoEnvio, 2) . "</strong></td>
            </tr>";

                $html .= "<tr>
                <td colspan='4' style='text-align:right'><strong>Descuento:</strong></td>
                <td><strong>" . number_format($descuento, 2) . "</strong></td>
            </tr>";

                $totalCotizacion = $subtotalMateriales + $costoEnvio - $descuento;

                $html .= "<tr>
                <td colspan='4' style='text-align:right'><strong>Total Cotización:</strong></td>
                <td><strong>" . number_format($totalCotizacion, 2) . "</strong></td>
            </tr>";

                $html .= "</tbody></table><br>";
            }

            $html .= "<h3>Total Orden de Compra</h3>";
            $html .= "<table>";
            $html .= "<tr>
            <td><strong>Total Orden:</strong></td>
            <td><strong>" . number_format((float)$orden->total_orden_compra, 2) . "</strong></td>
        </tr>";
            $html .= "</table>";

            $html .= "</body></html>";

            $pdf = Pdf::loadHTML($html);

            return $pdf->download('reporte_orden_' . $orden->codigo . '.pdf');
        } catch (\Exception $e) {
            $code = (int)$e->getCode() ?: 500;
            $mensaje = $e->getMessage() ?: "Error al generar PDF";
            $messageDTO = new MessageDTO(false, $mensaje, $code, null);
            return new ApiResponseResource($messageDTO);
        }
    }
}
