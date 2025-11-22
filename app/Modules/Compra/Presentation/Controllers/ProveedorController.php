<?php

namespace Modules\Compra\Presentation\Controllers;

use App\Models\TblProveedor;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class ProveedorController extends Controller
{
    public function index()
    {
        try {
            $proveedores = TblProveedor::orderBy('razon_social', 'asc')->get();

            if ($proveedores->isEmpty()) {
                return new ApiResponseResource(
                    new MessageDTO(
                        true,
                        "No existen proveedores registrados",
                        200,
                        []
                    )
                );
            }

            return new ApiResponseResource(
                new MessageDTO(
                    true,
                    "Listado de proveedores obtenido correctamente",
                    200,
                    $proveedores
                )
            );
        } catch (\Exception $e) {

            return new ApiResponseResource(
                new MessageDTO(
                    false,
                    "Error al obtener proveedores: " . $e->getMessage(),
                    500,
                    null
                )
            );
        }
    }

    public function store(Request $request)
    {
        try {
            $proveedor = TblProveedor::create([
                'razon_social'      => $request->razon_social,
                'nombre_comercial'  => $request->nombre_comercial,
                'ruc'               => $request->ruc,
                'direccion'         => $request->direccion,
                'telefono'          => $request->telefono,
                'correo'            => $request->correo,
                'pagina_web'        => $request->pagina_web,
                'contacto_nombre'   => $request->contacto_nombre,
                'contacto_telefono' => $request->contacto_telefono,
                'contacto_correo'   => $request->contacto_correo,
                'estado'            => 'Activo',
            ]);

            return new ApiResponseResource(
                new MessageDTO(
                    true,
                    "Proveedor registrado correctamente",
                    201,
                    $proveedor
                )
            );
        } catch (\Exception $e) {

            return new ApiResponseResource(
                new MessageDTO(
                    false,
                    "Error al registrar proveedor: " . $e->getMessage(),
                    500,
                    null
                )
            );
        }
    }

    public function show($id)
    {
        try {
            $proveedor = TblProveedor::findOrFail($id);

            return new ApiResponseResource(
                new MessageDTO(
                    true,
                    "Detalle del proveedor obtenido correctamente",
                    200,
                    $proveedor
                )
            );
        } catch (\Exception $e) {

            return new ApiResponseResource(
                new MessageDTO(
                    false,
                    "Proveedor no encontrado",
                    404,
                    null
                )
            );
        }
    }
}
