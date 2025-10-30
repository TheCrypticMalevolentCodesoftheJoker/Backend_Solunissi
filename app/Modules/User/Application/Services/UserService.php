<?php

namespace Modules\User\Application\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Modules\Shared\Application\DTOs\MessageDTO;
use Modules\User\Application\DTOs\UserCreateDTO;
use Modules\User\Application\DTOs\UserUpdateDTO;
use Modules\User\Application\UseCases\UserUseCase;

class UserService
{
    private UserUseCase $userUseCase;

    public function __construct(UserUseCase $userUseCase)
    {
        $this->userUseCase = $userUseCase;
    }
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-//
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-//
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-//

    public function ListUsers(): MessageDTO
    {
        try {
            $users = $this->userUseCase->ListUsers();
            return new MessageDTO(true, "Lista de usuarios obtenida con éxito", 200, $users);
        } catch (\Exception $e) {
            $code = $e->getCode() ?: 500;
            $mensaje = $e->getMessage() ?: null;
            return new MessageDTO(false, "Error: " . $mensaje, $code, null);
        }
    }

    public function createUser(UserCreateDTO $userCreateDTO): MessageDTO
    {
        try {
            return DB::transaction(function () use ($userCreateDTO) {
                $user = $this->userUseCase->createUser($userCreateDTO);
                return new MessageDTO(true, "Usuario {$user->nombre} creado correctamente.", 201, $user);
            });
        } catch (Exception $e) {
            $code = $e->getCode() ?: 500;
            $mensaje = $e->getMessage() ?: null;
            return new MessageDTO(false, "Error al crear usuario: " . $mensaje, $code, null);
        }
    }

    public function DetailUser(int $id): MessageDTO
    {
        try {
            $user = $this->userUseCase->DetailUser($id);
            return new MessageDTO(true, "Usuario {$user->nombre} obtenido con éxito", 200, $user);
        } catch (\Exception $e) {
            $code = $e->getCode() ?: 500;
            $mensaje = $e->getMessage() ?: null;
            return new MessageDTO(false, "Error: " . $mensaje, $code, null);
        }
    }

    public function updateUser(UserUpdateDTO $userUpdateDTO): MessageDTO
    {
        try {
            return DB::transaction(function () use ($userUpdateDTO) {
                $user = $this->userUseCase->updateUser($userUpdateDTO);
                return new MessageDTO(true, "Usuario {$user->nombre} actualizado correctamente.", 200, $user);
            });
        } catch (Exception $e) {
            $code = $e->getCode() ?: 500;
            $mensaje = $e->getMessage() ?: null;
            return new MessageDTO(false,  "Error al actualizar usuario: " . $mensaje, $code, null);
        }
    }

    public function deleteUser(int $id): MessageDTO
    {
        try {
            return DB::transaction(function () use ($id) {
                $deletedUser = $this->userUseCase->deleteUser($id);
                return new MessageDTO(true, "Usuario {$deletedUser->nombre} desactivado correctamente.", 200, $deletedUser);
            });
        } catch (Exception $e) {
            $code = $e->getCode() ?: 500;
            $mensaje = $e->getMessage() ?: null;
            return new MessageDTO(false, "Error: " . $mensaje, $code, null);
        }
    }
}
