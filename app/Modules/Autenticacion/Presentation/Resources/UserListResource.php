<?php

namespace Modules\Autenticacion\Presentation\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserListResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'usuarioID' => $this->usuarioID,
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'estado' => $this->estado,
            'nombreRol' => $this->nombreRol,
            'createdAt' => $this->createdAt,
        ];
    }
}
