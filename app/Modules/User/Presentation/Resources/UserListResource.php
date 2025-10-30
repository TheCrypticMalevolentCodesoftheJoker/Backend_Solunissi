<?php

namespace Modules\User\Presentation\Resources;

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
            'rol' => $this->rol,
            'createdAt' => $this->createdAt,
        ];
    }
}
