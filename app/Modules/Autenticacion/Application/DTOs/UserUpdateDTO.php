<?php

namespace Modules\Autenticacion\Application\DTOs;

class UserUpdateDTO
{

    public int $usuarioID;
    public string $nombre;
    public string $apellidos;
    public ?string $telefono;
    public string $email;
    public string $contrasena;
    public bool $estado;
    public int $rolID;

    public function __construct(
        int $usuarioID,
        string $nombre,
        string $apellidos,
        ?string $telefono,
        string $email,
        string $contrasena,
        bool $estado,
        int $rolID,
    ) {
        $this->usuarioID = $usuarioID;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->contrasena = $contrasena;
        $this->estado = $estado;
        $this->rolID = $rolID;
    }
}
