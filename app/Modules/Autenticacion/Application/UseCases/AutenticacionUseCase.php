<?php

namespace Modules\Autenticacion\Application\UseCases;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Modules\Autenticacion\Application\DTOs\LoginDTO;
use Modules\Autenticacion\Domain\Interfaces\UserInterface;

class AutenticacionUseCase
{
    private UserInterface $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-//
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-//
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-//
    public function login(LoginDTO $loginDTO): LoginDTO
    {
        $usuario = $this->userInterface->findByEmail($loginDTO->email);

        if (!$usuario) {
            throw new \Exception("Credenciales incorrectas", 401);
        }

        if (!Hash::check($loginDTO->contrasena, $usuario->contrasena)) {
            throw new \Exception("Credenciales incorrectas", 401);
        }

        $usuario->ultimoLogin = Carbon::now();
        $this->userInterface->updateLastLogin($usuario->usuarioID, $usuario->ultimoLogin);

        // Crear token
   
        return new LoginDTO(
            email: $usuario->email,
            contrasena: $usuario->contrasena,
            usuarioID: $usuario->usuarioID,
            nombre: $usuario->nombre,
            apellidos: $usuario->apellidos,
            rolID: $usuario->rolID,
            nombreRol: $usuario->nombreRol,
        );
    }
}
