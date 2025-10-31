<?php

namespace Modules\Autenticacion\Application\DTOs;

class UserCreateDTO{

    public string $nombre;
    public string $apellidos;
    public ?string $telefono;
    public string $email;
    public string $contrasena;
    public int $rolID;

    public function __construct(
        string $nombre,
        string $apellidos,
        ?string $telefono,
        string $email,
        string $contrasena,
        int $rolID
    ) {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->contrasena = $contrasena;
        $this->rolID = $rolID;
    }
}