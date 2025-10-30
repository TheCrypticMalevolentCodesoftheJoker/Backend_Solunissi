<?php

namespace Modules\User\Domain\Entities;

class UserEntity
{
    public int $usuarioID;
    public string $nombre;
    public string $apellidos;
    public ?string $telefono;
    public string $email;
    public string $contrasena;
    public bool $estado;
    public int $rolID;
    public ?string $nombreRol;
    public ?\DateTime $ultimoLogin;
    public ?string $rememberToken;
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
        ?string $nombreRol = null,
        ?\DateTime $ultimoLogin = null,
        ?string $rememberToken = null,
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
        $this->nombreRol = $nombreRol;
        $this->ultimoLogin = $ultimoLogin;
        $this->rememberToken = $rememberToken;
        $this->createdAt = $createdAt ?? new \DateTime();
        $this->updatedAt = $updatedAt ?? new \DateTime();
    }
    public function desactivar(): void
    {
        $this->estado = false;
    }

    public function activar(): void
    {
        $this->estado = true;
    }
}
