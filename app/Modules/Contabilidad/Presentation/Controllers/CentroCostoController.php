<?php

namespace Modules\Contabilidad\Presentation\Controllers;

use App\Models\TblCentroCosto;
use Illuminate\Routing\Controller;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class CentroCostoController extends Controller
{
    public function index()
    {
        try {
            $items = TblCentroCosto::select('id', 'nombre', 'descripcion')->orderBy('nombre')->get();

            if ($items->isEmpty()) {
                $dto = new MessageDTO(true, "No existen centros de costo registrados", 204, []);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, "Centros de costo obtenidos correctamente", 200, $items);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $code = $e->getCode() ?: 500;
            $mensaje = $e->getMessage() ?: "Error al obtener centros de costo";

            $dto = new MessageDTO(false, $mensaje, $code, null);
            return new ApiResponseResource($dto);
        }
    }
}