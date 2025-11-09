<?php

namespace Modules\RRHH\Presentation\Controllers;

use App\Models\TblCargo;
use Illuminate\Routing\Controller;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class CargoController extends Controller
{
    public function index()
    {
        try {
            $query = TblCargo::select('id', 'nombre', 'salario_base', 'created_at', 'updated_at')
                ->orderBy('id');

            $items = $query->get();

            if ($items->isEmpty()) {
                $dto = new MessageDTO(true, "No existen cargos registrados", 204, null);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, "Cargos obtenidos correctamente", 200, $items);
            return new ApiResponseResource($dto);

        } catch (\Exception $e) {
            $code = $e->getCode() ?: 500;
            $mensaje = $e->getMessage() ?: "Error al obtener cargos";

            $dto = new MessageDTO(false, $mensaje, $code, null);
            return new ApiResponseResource($dto);
        }
    }
}
