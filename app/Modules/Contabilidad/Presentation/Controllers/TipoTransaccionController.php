<?php

namespace Modules\Contabilidad\Presentation\Controllers;

use App\Models\TblTipoTransaccionContable;
use Illuminate\Routing\Controller;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class TipoTransaccionController extends Controller
{
    public function index()
    {
        try {
            $items = TblTipoTransaccionContable::select('id', 'nombre', 'descripcion')->orderBy('id')->get();

            if ($items->isEmpty()) {
                $dto = new MessageDTO(true, "No existen tipos de transacción registrados", 204, []);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, "Tipos de transacción obtenidos correctamente", 200, $items);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $code = $e->getCode() ?: 500;
            $mensaje = $e->getMessage() ?: "Error al obtener tipos de transacción";

            $dto = new MessageDTO(false, $mensaje, $code, null);
            return new ApiResponseResource($dto);
        }
    }
}