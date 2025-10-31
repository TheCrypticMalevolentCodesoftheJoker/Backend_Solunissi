<?php

namespace Modules\Autenticacion\Application\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Modules\Autenticacion\Application\DTOs\LoginDTO;
use Modules\Autenticacion\Application\UseCases\AutenticacionUseCase;
use Modules\Shared\Application\DTOs\MessageDTO;

class AutenticacionService
{
    private AutenticacionUseCase $autenticacionUseCase;

    public function __construct(AutenticacionUseCase $autenticacionUseCase)
    {
        $this->autenticacionUseCase = $autenticacionUseCase;
    }
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-//
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-//
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-//
    public function login(LoginDTO $loginDTO): MessageDTO
    {
        try {
            return DB::transaction(function () use ($loginDTO) {
                $userLogueado = $this->autenticacionUseCase->login($loginDTO);
                return new MessageDTO(true, "Bienvenido, {$userLogueado->nombre}. Has iniciado sesión correctamente.", 200, $userLogueado);
            });
        } catch (Exception $e) {
            $code = $e->getCode() ?: 500;
            $mensaje = $e->getMessage() ?: "Error al iniciar sesión";
            return new MessageDTO(false, $mensaje, $code, null);
        }
    }
}
