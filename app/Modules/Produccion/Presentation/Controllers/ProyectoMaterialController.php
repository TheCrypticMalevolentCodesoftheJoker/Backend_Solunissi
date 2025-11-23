<?php

namespace Modules\Produccion\Presentation\Controllers;

use App\Models\TblProyectoMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class ProyectoMaterialController extends Controller
{
    public function index()
    {
        try {
            $materiales = TblProyectoMaterial::with(['tbl_proyecto', 'tbl_material'])
                ->orderBy('fecha_asignacion', 'desc')
                ->get();

            $msg = $materiales->isEmpty()
                ? "No hay materiales asignados"
                : "Listado obtenido correctamente";

            return new ApiResponseResource(
                new MessageDTO(true, $msg, 200, $materiales)
            );
        } catch (\Exception $e) {
            return new ApiResponseResource(
                new MessageDTO(false, $e->getMessage(), 500, null)
            );
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $registrados = [];

            foreach ($request->materiales as $m) {
                $existente = TblProyectoMaterial::where('proyecto_id', $request->proyecto_id)
                    ->where('material_id', $m['material_id'])
                    ->first();

                if ($existente) {
                    $existente->cantidad += $m['cantidad'];
                    $existente->save();

                    $registrados[] = $existente;
                } else {
                    $registrados[] = TblProyectoMaterial::create([
                        'proyecto_id'      => $request->proyecto_id,
                        'material_id'      => $m['material_id'],
                        'cantidad'         => $m['cantidad'],
                        'fecha_asignacion' => now(),
                    ]);
                }
            }

            DB::commit();

            return new ApiResponseResource(
                new MessageDTO(true, "Materiales registrados/actualizados correctamente", 201, $registrados)
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return new ApiResponseResource(
                new MessageDTO(false, $e->getMessage(), 500, null)
            );
        }
    }

    public function show($id)
    {
        try {
            $material = TblProyectoMaterial::with(['tbl_proyecto', 'tbl_material'])->find($id);

            if (!$material) {
                return new ApiResponseResource(
                    new MessageDTO(false, "Material asignado no encontrado", 404, null)
                );
            }

            return new ApiResponseResource(
                new MessageDTO(true, "Detalle obtenido correctamente", 200, $material)
            );
        } catch (\Exception $e) {
            return new ApiResponseResource(
                new MessageDTO(false, $e->getMessage(), 500, null)
            );
        }
    }
}
