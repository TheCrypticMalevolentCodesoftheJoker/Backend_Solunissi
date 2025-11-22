<?php

namespace Modules\Logistica\Presentation\Controllers;

use App\Models\TblSMPendiente;
use Illuminate\Routing\Controller;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class SolicitudMaterialPendienteController extends Controller
{
    public function index()
    {
        try {
            $pendientes = TblSMPendiente::with([
                'tbl_solicitud_material',
                'tbl_proyecto',
                'tbl_s_m_pendiente_detalles.tbl_material'
            ])->orderBy('fecha', 'desc')->get();

            if ($pendientes->isEmpty()) {
                return new ApiResponseResource(
                    new MessageDTO(
                        true,
                        "No existen solicitudes de materiales pendientes registradas",
                        200,
                        []
                    )
                );
            }

            $dto = new MessageDTO(
                true,
                "Listado de solicitudes de materiales pendientes obtenido correctamente",
                200,
                $pendientes
            );

            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }

    public function show($id)
    {
        try {
            $pendiente = TblSMPendiente::with([
                'tbl_solicitud_material',
                'tbl_proyecto',
                'tbl_s_m_pendiente_detalles.tbl_material'
            ])->find($id);

            if (!$pendiente) {
                return new ApiResponseResource(
                    new MessageDTO(
                        true,
                        "No se encontró la solicitud de material pendiente con ID {$id}",
                        200,
                        null
                    )
                );
            }

            $dto = new MessageDTO(
                true,
                "Solicitud de material pendiente obtenida correctamente",
                200,
                $pendiente
            );

            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }
}
