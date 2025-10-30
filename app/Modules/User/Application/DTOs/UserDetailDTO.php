<?php

namespace Modules\User\Application\DTOs;

class UserDetailDTO
{
    public int $usuarioID;
    public string $nombre;
    public string $apellidos;
    public ?string $telefono;
    public string $email;
    public string $contrasena;
    public bool $estado;
    public int $rolID;
    public string $rol;
    public ?\DateTime $ultimoLogin;
    public ?\DateTime $createdAt;
    public ?\DateTime $updatedAt;

    public function __construct(
        int $usuarioID,
        string $nombre,
        string $apellidos,
        ?string $telefono,
        string $email,
        string $contrasena,
        bool $estado,
        int $rolID,
        string $rol,
        ?\DateTime $ultimoLogin = null,
        ?\DateTime $createdAt = null,
        ?\DateTime $updatedAt = null
    ) {
        $this->usuarioID = $usuarioID;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->contrasena = $contrasena;
        $this->estado = $estado;
        $this->rolID = $rolID;
        $this->rol = $rol;
        $this->ultimoLogin = $ultimoLogin;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
}
