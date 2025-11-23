<?php

namespace Modules\Compra\Presentation\Controllers;

use App\Models\TblCompra;
use Illuminate\Routing\Controller;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class SolicitudCompraController extends Controller
{
    public function index()
    {
        try {
            $solicitudes = TblCompra::with(['tbl_proyecto'])
                ->orderBy('fecha_solicitud', 'desc')
                ->get();

            if ($solicitudes->isEmpty()) {
                return new ApiResponseResource(
                    new MessageDTO(true, "No existen solicitudes de compra registradas", 200, null)
                );
            }

            return new ApiResponseResource(
                new MessageDTO(true, "Listado de solicitudes de compra obtenido correctamente", 200, $solicitudes)
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
            $solicitud = TblCompra::with([
                'tbl_proyecto',
                'tbl_soli_mat',
                'tbl_compra_detalles.tbl_material'
            ])->find($id);

            if ($solicitud->tbl_compra_detalles->isEmpty()) {
                return new ApiResponseResource(
                    new MessageDTO(true,"Sin Detalles",200,$solicitud)
                );
            }

            return new ApiResponseResource(
                new MessageDTO(true,"Detalle de la solicitud de compra obtenido correctamente",200,$solicitud)
            );
        } catch (\Exception $e) {

            return new ApiResponseResource(
                new MessageDTO(false, $e->getMessage(), 500, null)
            );
        }
    }
}
