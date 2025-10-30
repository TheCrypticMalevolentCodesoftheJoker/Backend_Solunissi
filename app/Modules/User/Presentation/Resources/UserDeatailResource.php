<?php

namespace Modules\User\Presentation\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserDeatailResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'usuarioID' => $this->usuarioID,
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'contrasena' => $this->contrasena,
            'estado' => $this->estado,
            'rolID' => $this->rolID,
            'rol' => $this->rol,
            'ultimoLogin' => $this->ultimoLogin,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt
        ];
    }
}
