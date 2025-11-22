<?php

namespace Modules\Compra\Presentation\Controllers;

use Illuminate\Routing\Controller;
use App\Models\TblSolicitudCompra;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class SolicitudCompraController extends Controller
{
    public function index()
    {
        try {
            $solicitudes = TblSolicitudCompra::with([
                'tbl_proyecto',
                'tbl_solicitud_compra_detalles.tbl_material',
            ])
                ->orderBy('fecha_solicitud', 'desc')
                ->get();
            if ($solicitudes->isEmpty()) {
                return new ApiResponseResource(
                    new MessageDTO(
                        true,
                        "No existen solicitudes de compra registradas",
                        200,
                        []
                    )
                );
            }

            return new ApiResponseResource(
                new MessageDTO(
                    true,
                    "Listado de solicitudes de compra obtenido correctamente",
                    200,
                    $solicitudes
                )
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

            $solicitud = TblSolicitudCompra::with([
                'tbl_proyecto',
                'tbl_solicitud_compra_detalles.tbl_material',
            ])->find($id);

            if (!$solicitud) {
                return new ApiResponseResource(
                    new MessageDTO(
                        false,
                        "No se encontró la solicitud de compra con ID: $id",
                        404,
                        null
                    )
                );
            }
            if ($solicitud->tbl_solicitud_compra_detalles->isEmpty()) {
                return new ApiResponseResource(
                    new MessageDTO(
                        true,
                        "La solicitud existe, pero no tiene detalles registrados",
                        200,
                        $solicitud
                    )
                );
            }

            return new ApiResponseResource(
                new MessageDTO(
                    true,
                    "Detalle de la solicitud de compra obtenido correctamente",
                    200,
                    $solicitud
                )
            );
        } catch (\Exception $e) {

            return new ApiResponseResource(
                new MessageDTO(false, $e->getMessage(), 500, null)
            );
        }
    }
}
