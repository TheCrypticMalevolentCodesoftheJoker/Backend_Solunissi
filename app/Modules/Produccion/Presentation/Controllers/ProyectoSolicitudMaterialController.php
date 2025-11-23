<?php

namespace Modules\Produccion\Presentation\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use App\Models\TblAlmacenMaterial;
use App\Models\TblCompra;
use App\Models\TblCompraDetalle;
use App\Models\TblDespacho;
use App\Models\TblDespachoDetalle;
use App\Models\TblProyecto;
use App\Models\TblSoliMat;
use App\Models\TblSoliMatDet;
use App\Models\TblSoliMatPend;
use App\Models\TblSoliMatPendDet;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;


class ProyectoSolicitudMaterialController extends Controller
{

    public function index()
    {
        $solicitudes = TblSoliMat::with(['tbl_proyecto'])
            ->orderBy('id', 'desc')
            ->get();

        if ($solicitudes->isEmpty()) {
            return new ApiResponseResource(
                new MessageDTO(false, "No existen solicitudes registradas", 404, [])
            );
        }

        return new ApiResponseResource(
            new MessageDTO(true, "Listado de solicitudes obtenido correctamente", 200, $solicitudes)
        );
    }


    public function show($id)
    {
        $solicitud = TblSoliMat::with([
            'tbl_proyecto',
            'tbl_soli_mat_dets.tbl_material'
        ])
            ->find($id);

        if ($solicitud->tbl_soli_mat_dets->isEmpty()) {
            return new ApiResponseResource(
                new MessageDTO(false, "Sin detalles", 204, $solicitud)
            );
        }

        return new ApiResponseResource(
            new MessageDTO(true, "Solicitud obtenida correctamente", 200, $solicitud)
        );
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $proyecto = TblProyecto::findOrFail($request->proyecto_id);
            $solicitud = TblSoliMat::create([
                'codigo' => 'SOLM-' . str_pad(TblSoliMat::max('id') + 1, 5, '0', STR_PAD_LEFT),
                'proyecto_id' => $proyecto->id,
                'fecha_solicitud' => now(),
                'estado' => 'Pendiente',
            ]);
            foreach ($request->materiales as $m) {
                TblSoliMatDet::create([
                    'soli_mat_id' => $solicitud->id,
                    'material_id' => $m['material_id'],
                    'cantidad' => $m['cantidad'],
                    'estado' => 'Pendiente'
                ]);
            }

            $despacho = [];
            $traslado = [];
            $compra = [];
            $estadoMaterial = [];

            foreach ($request->materiales as $m) {

                $materialId = $m['material_id'];
                $cantidadSolicitada = $m['cantidad'];
                $cantidadPendiente = $cantidadSolicitada;

                $estadoActual = [];
                $stockProyecto = TblAlmacenMaterial::where('almacen_id', $proyecto->almacen_id)->where('proyecto_id', $proyecto->id)->where('material_id', $materialId)->value('stock') ?? 0;
                $stockCentral = TblAlmacenMaterial::where('almacen_id', 1)->where('material_id', $materialId)->value('stock') ?? 0;
                if ($stockProyecto > 0) {
                    $cantidadDespacho = min($cantidadPendiente, $stockProyecto);

                    if ($cantidadDespacho > 0) {
                        $despacho[] = [
                            'material_id' => $materialId,
                            'cantidad' => $cantidadDespacho
                        ];

                        $estadoActual[] = "recoger";
                        $cantidadPendiente -= $cantidadDespacho;
                    }
                }
                if ($cantidadPendiente > 0 && $stockCentral > 0) {
                    $cantidadTraslado = min($cantidadPendiente, $stockCentral);

                    $traslado[] = [
                        'material_id' => $materialId,
                        'cantidad' => $cantidadTraslado
                    ];

                    $estadoActual[] = "trasladar";
                    $cantidadPendiente -= $cantidadTraslado;
                }
                if ($cantidadPendiente > 0) {
                    $compra[] = [
                        'material_id' => $materialId,
                        'cantidad' => $cantidadPendiente
                    ];

                    $estadoActual[] = "comprar";
                }

                $estadoMaterial[$materialId] = match (implode("-", $estadoActual)) {
                    "recoger" => "por recoger",
                    "trasladar" => "por trasladar",
                    "comprar" => "por comprar",
                    "recoger-trasladar" => "recoger/trasladar",
                    "recoger-comprar" => "recoger/comprar",
                    "trasladar-comprar" => "trasladar/comprar",
                    "recoger-trasladar-comprar" => "mixto",
                    default => "pendiente"
                };
            }

            foreach ($estadoMaterial as $materialId => $estadoFinal) {
                TblSoliMatDet::where('soli_mat_id', $solicitud->id)
                    ->where('material_id', $materialId)
                    ->update(['estado' => $estadoFinal]);
            }

            $todosCompletados = collect($estadoMaterial)->every(
                fn($estado) => $estado === "por recoger"
            );

            $estadoSolicitud = $todosCompletados ? "Completado" : "Incompleto";
            $solicitud->update(['estado' => $estadoSolicitud]);

            if (!empty($despacho)) {
                $this->registrarDespacho($despacho, $solicitud->id, $proyecto->id);
            }
            if (!empty($traslado)) {
                $this->registrarTrasladoPendiente($traslado, $solicitud->id, $proyecto->id);
            }
            if (!empty($compra)) {
                $this->registrarCompraPendiente($compra, $solicitud->id, $proyecto->id);
            }

            DB::commit();
            return new ApiResponseResource(
                new MessageDTO(true, "Clasificación realizada correctamente", 200, null)
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return new ApiResponseResource(
                new MessageDTO(false, $e->getMessage(), 500, null)
            );
        }
    }


    //  FUNCIONES AUXILIARES

    private function registrarDespacho(array $items, int $solicitudId, int $proyectoId)
    {
        $cabecera = TblDespacho::create([
            'soli_mat_id' => $solicitudId,
            'proyecto_id' => $proyectoId,
            'fecha'       => now(),
            'estado'      => 'pendiente',
        ]);
        foreach ($items as $item) {
            TblDespachoDetalle::create([
                'despacho_id' => $cabecera->id,
                'material_id' => $item['material_id'],
                'cantidad'    => $item['cantidad'],
            ]);
        }
    }
    private function registrarTrasladoPendiente(array $items, int $solicitudId, int $proyectoId)
    {
        $cab = TblSoliMatPend::create([
            'soli_mat_id' => $solicitudId,
            'proyecto_id' => $proyectoId,
            'tipo' => 'traslado',
            'estado' => 'pendiente',
            'fecha' => now(),
        ]);
        foreach ($items as $item) {
            TblSoliMatPendDet::create([
                'soli_mat_pend_id' => $cab->id,
                'material_id'      => $item['material_id'],
                'cantidad'         => $item['cantidad'],
            ]);
        }
    }
    private function registrarCompraPendiente(array $items, int $solicitudId, int $proyectoId)
    {
        $compra = TblCompra::create([
            'codigo' => 'COMP-' . str_pad(TblCompra::max('id') + 1, 5, '0', STR_PAD_LEFT),
            'soli_mat_id'   => $solicitudId,
            'proyecto_id'   => $proyectoId,
            'fecha_solicitud' => now(),
            'estado'        => 'Pendiente',
        ]);
        foreach ($items as $item) {
            TblCompraDetalle::create([
                'compra_id'   => $compra->id,
                'material_id' => $item['material_id'],
                'cantidad'    => $item['cantidad'],
            ]);
        }
        $cab = TblSoliMatPend::create([
            'soli_mat_id' => $solicitudId,
            'proyecto_id' => $proyectoId,
            'tipo' => 'compra',
            'estado' => 'pendiente',
            'fecha' => now(),
        ]);
        foreach ($items as $item) {
            TblSoliMatPendDet::create([
                'soli_mat_pend_id' => $cab->id,
                'material_id'      => $item['material_id'],
                'cantidad'         => $item['cantidad'],
            ]);
        }
    }
}
