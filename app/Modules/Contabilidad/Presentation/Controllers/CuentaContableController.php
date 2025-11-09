<?php

namespace Modules\Contabilidad\Presentation\Controllers;

use App\Models\TblCuentaContable;
use Illuminate\Routing\Controller;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class CuentaContableController extends Controller
{
    public function index()
    {
        try {
            $query = TblCuentaContable::select('id', 'codigo', 'nombre', 'tipo', 'descripcion')
                ->orderBy('codigo');

            $items = $query->get();

            if ($items->isEmpty()) {
                $dto = new MessageDTO(true, "No existen cuentas contables registradas", 204, []);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, "Cuentas contables obtenidas correctamente", 200, $items);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $code = $e->getCode() ?: 500;
            $mensaje = $e->getMessage() ?: "Error al obtener cuentas contables";

            $dto = new MessageDTO(false, $mensaje, $code, null);
            return new ApiResponseResource($dto);
        }
    }
}