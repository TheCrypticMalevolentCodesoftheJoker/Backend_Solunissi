<?php

namespace Modules\Autenticacion\Presentation\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'email' => $this->email,
            'contrasena' => $this->contrasena,
            'usuarioID' => $this->usuarioID,
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'rolID' => $this->rolID,
            'nombreRol' => $this->nombreRol,
        ];
    }
}
