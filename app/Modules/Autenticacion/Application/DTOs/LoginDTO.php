<?php

namespace Modules\Autenticacion\Application\DTOs;

class LoginDTO
{
    public string $email;
    public string $contrasena;
    public ?int $usuarioID;
    public ?string $nombre;
    public ?string $apellidos;
    public ?int $rolID;
    public ?string $nombreRol;

    public function __construct(
        string $email,
        string $contrasena,
        ?int $usuarioID = null,
        ?string $nombre = null,
        ?string $apellidos = null,
        ?int $rolID = null,
        ?string $nombreRol = null,
    ) {
        $this->email = $email;
        $this->contrasena = $contrasena;
        $this->usuarioID = $usuarioID;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->rolID = $rolID;
        $this->nombreRol = $nombreRol;
    }
}