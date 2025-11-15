<?php

namespace Modules\Venta\Presentation\Controllers;

use App\Models\TblFactura;
use Illuminate\Routing\Controller;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class FacturaController extends Controller
{
    public function index()
    {
        try {
            $facturas = TblFactura::with(['tbl_contrato', 'tbl_proyecto'])
                ->orderBy('id', 'desc')
                ->get();

            if ($facturas->isEmpty()) {
                $dto = new MessageDTO(true, 'No hay facturas registradas aún', 200, []);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, 'Lista de facturas', 200, $facturas);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }

    public function show($id)
    {
        try {
            $factura = TblFactura::with(['tbl_contrato', 'tbl_proyecto'])->find($id);

            if (!$factura) {
                $dto = new MessageDTO(false, 'Factura no encontrada', 404, null);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, 'Detalle de la factura', 200, $factura);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }
}
