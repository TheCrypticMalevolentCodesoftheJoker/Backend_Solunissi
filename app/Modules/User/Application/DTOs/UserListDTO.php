<?php

namespace Modules\User\Application\DTOs;

class UserListDTO
{
    public int $usuarioID;
    public string $nombre;
    public string $apellidos;
    public ?string $telefono;
    public string $email;
    public bool $estado;
    public string $rol;
    public ?\DateTime $createdAt;

    public function __construct(
        int $usuarioID,
        string $nombre,
        string $apellidos,
        ?string $telefono,
        string $email,
        bool $estado,
        string $rol,
        ?\DateTime $createdAt = null
    ) {
        $this->usuarioID = $usuarioID;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->estado = $estado;
        $this->rol = $rol;
        $this->createdAt = $createdAt;
    }
}
