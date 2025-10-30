<?php

namespace Modules\User\Application\DTOs;

class UserCreateDTO{

    public string $nombre;
    public string $apellidos;
    public ?string $telefono;
    public string $email;
    public string $contrasena;
    public int $rolId;

    public function __construct(
        string $nombre,
        string $apellidos,
        ?string $telefono,
        string $email,
        string $contrasena,
        int $rolId
    ) {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->contrasena = $contrasena;
        $this->rolId = $rolId;
    }
}