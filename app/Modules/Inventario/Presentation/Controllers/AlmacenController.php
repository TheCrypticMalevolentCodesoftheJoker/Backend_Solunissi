<?php

namespace Modules\Inventario\Presentation\Controllers;

use App\Models\TblAlmacen;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\Shared\Presentation\Resources\ApiResponseResource;

class AlmacenController extends Controller
{
    public function index()
    {
        try {
            $almacenes = TblAlmacen::all();

            if ($almacenes->isEmpty()) {
                $dto = new MessageDTO(true, 'No hay almacenes registrados.', 200, []);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, 'Lista de almacenes obtenida correctamente', 200, $almacenes);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $almacen = TblAlmacen::create([
                'codigo' => 'ALM-' . str_pad(TblAlmacen::max('id') + 1, 5, '0', STR_PAD_LEFT),
                'nombre'    => $request->nombre,
                'ubicacion' => $request->ubicacion,
                'estado'    => 'Activo',
            ]);

            DB::commit();
            $dto = new MessageDTO(true, 'Almacén registrado correctamente', 201, null);

            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            DB::rollBack();
            $dto = new MessageDTO(false, $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }

    public function show($id)
    {
        try {
            $almacen = TblAlmacen::find($id);

            if (!$almacen) {
                $dto = new MessageDTO(false, 'El almacén no existe.', 404, null);
                return new ApiResponseResource($dto);
            }

            $dto = new MessageDTO(true, 'Almacén encontrado correctamente.', 200, $almacen);
            return new ApiResponseResource($dto);
        } catch (\Exception $e) {
            $dto = new MessageDTO(false, $e->getMessage(), 500, null);
            return new ApiResponseResource($dto);
        }
    }
}
