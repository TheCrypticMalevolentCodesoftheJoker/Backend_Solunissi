<?php

namespace Modules\Proyecto\Presentation\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\TblFactura;
use App\Models\TblProyecto;
use App\Models\TblTransaccionContable;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class ProyectoController extends Controller
{
    public function index()
    {
        try {
            $proyectos = TblProyecto::with([
                'tbl_almacen:id,nombre',
                'tbl_empleado:id,nombres,apellidos',
                'tbl_contrato:id,codigo'
            ])
                ->orderBy('id', 'desc')
                ->get();

            $mensaje = $proyectos->isNotEmpty()
                ? 'Proyectos cargados.'
                : 'Sin proyectos.';

            $dto = new MessageDTO(true, $mensaje, 200, $proyectos);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, 'Error interno', 500, null);
            return new ApiResponseResource($dto);
        }
    }

    public function show($ProyectoId)
    {
        try {

            $proyecto = TblProyecto::with([
                'tbl_almacen:id,nombre',
                'tbl_empleado:id,nombres,apellidos,dni',
                'tbl_contrato:id,codigo'
            ])->findOrFail($ProyectoId);

            $dto = new MessageDTO(true, 'Proyecto detallado', 200, $proyecto);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, $e->getMessage(), 404, null);
            return new ApiResponseResource($dto);
        }
    }

    public function update(Request $request, $ProyectoId)
    {
        DB::beginTransaction();
        try {
            $proyecto = TblProyecto::findOrFail($ProyectoId);
            $proyecto->update([
                'almacen_id' => $request->almacen_id,
                'supervisor_id' => $request->supervisor_id,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
                'monto_ejecutado' => 0,
                'estado' => 'Inicializado',
            ]);

            DB::commit();
            $dto = new MessageDTO(true, 'Proyecto inicializado correctamente', 200, null);

            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            DB::rollBack();
            $dto = new MessageDTO(false, $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }
    // depende de endpoints almacen(Invetario), supervisores(RRHH)

    public function finalizarProyecto($ProyectoId)
    {
        DB::beginTransaction();

        try {
            $proyecto = TblProyecto::findOrFail($ProyectoId);

            if ($proyecto->estado === 'Finalizado') {
                return new ApiResponseResource(
                    new MessageDTO(false, 'El proyecto ya fue finalizado previamente', 400, null)
                );
            }

            $contrato = $proyecto->tbl_contrato;

            $proyecto->update([
                'fecha_fin' => now(),
                'estado' => 'Finalizado',
            ]);

            $totalPagos = $contrato->tbl_contrato_pagos()
                ->where('estado', 'Efectuado')
                ->sum('monto');

            $montoFactura = $contrato->monto_total - $totalPagos;

            $estadoFactura = $montoFactura <= 0 ? 'Efectuado' : 'Pendiente';

            $factura = TblFactura::create([
                'codigo' => 'FAC-' . str_pad((TblFactura::max('id') + 1), 5, '0', STR_PAD_LEFT),
                'contrato_id' => $contrato->id,
                'proyecto_id' => $proyecto->id,
                'fecha_emision' => now(),
                'monto_total' => max($montoFactura, 0),
                'estado' => $estadoFactura,
            ]);

            if ($montoFactura > 0) {
                TblTransaccionContable::create([
                    'fecha_registro' => now(),
                    'proyecto_id' => $proyecto->id,
                    'tipo_transaccion_contable_id' => 1,
                    'centro_costo_id' => 6,
                    'monto_total' => $montoFactura,
                    'modulo_origen' => 'Venta',
                    'referencia_id' => $factura->codigo,
                    'descripcion' => "Factura final del contrato {$contrato->codigo} para proyecto {$proyecto->nombre}",
                    'estado' => 'Pendiente',
                ]);

                $contrato->update([
                    'estado' => 'Pendiente de pago'
                ]);
            } else {
                $contrato->update([
                    'estado' => 'Finalizado'
                ]);
            }

            DB::commit();

            $dto = new MessageDTO(true, 'Proyecto finalizado correctamente', 200, null);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            DB::rollBack();
            return new ApiResponseResource(
                new MessageDTO(false, $e->getMessage(), 500, null)
            );
        }
    }
}
