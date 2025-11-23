<?php

namespace Modules\Inventario\Presentation\Controllers;

use App\Models\TblAlmacen;
use App\Models\TblAlmacenMaterial;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class AlmacenMaterialController extends Controller
{
    public function index()
    {
        try {
            $almacenMaterial = TblAlmacenMaterial::with(['tbl_almacen', 'tbl_proyecto',])->get();
            if ($almacenMaterial->isEmpty()) {
                return new ApiResponseResource(
                    new MessageDTO(true, "No existen registros de materiales en almacenes", 200, null)
                );
            }
            return new ApiResponseResource(
                new MessageDTO(true, "Listado obtenido correctamente", 200, $almacenMaterial)
            );
        } catch (\Exception $e) {

            return new ApiResponseResource(
                new MessageDTO(false, $e->getMessage(), 500, null)
            );
        }
    }
    public function show($id)
    {
        try {

            $registro = TblAlmacenMaterial::with(['tbl_almacen', 'tbl_proyecto', 'tbl_material'])->find($id);

            if (!$registro) {
                return new ApiResponseResource(
                    new MessageDTO(false, "No se encontró el registro de almacén-material con ID: $id", 404, null)
                );
            }

            return new ApiResponseResource(
                new MessageDTO(true, "Detalle obtenido correctamente", 200, $registro)
            );
        } catch (\Exception $e) {
            return new ApiResponseResource(
                new MessageDTO(false, $e->getMessage(), 500, null)
            );
        }
    }
}
