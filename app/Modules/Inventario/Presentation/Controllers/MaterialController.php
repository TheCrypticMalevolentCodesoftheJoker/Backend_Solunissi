<?php

namespace Modules\Inventario\Presentation\Controllers;

use App\Models\TblMaterial;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class MaterialController extends Controller
{

    public function index()
    {
        try {
            $materiales = TblMaterial::all();

            if ($materiales->isEmpty()) {
                return new ApiResponseResource(
                    new MessageDTO(false, 'No hay materiales registrados', 404, [])
                );
            }

            return new ApiResponseResource(
                new MessageDTO(true, 'Lista de materiales obtenida correctamente', 200, $materiales)
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
            $material = TblMaterial::create([
                'codigo' => 'MAT-' . str_pad(TblMaterial::max('id') + 1, 5, '0', STR_PAD_LEFT),
                'nombre'        => $request->nombre,
                'unidad_medida' => $request->unidad_medida,
            ]);

            DB::commit();

            return new ApiResponseResource(
                new MessageDTO(true, 'Material registrado correctamente', 201, $material)
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
            $material = TblMaterial::find($id);

            if (!$material) {
                return new ApiResponseResource(
                    new MessageDTO(false, 'Material no encontrado', 404, null)
                );
            }

            return new ApiResponseResource(
                new MessageDTO(true, 'Material obtenido correctamente', 200, $material)
            );
        } catch (\Exception $e) {

            return new ApiResponseResource(
                new MessageDTO(false, $e->getMessage(), 500, null)
            );
        }
    }
}
