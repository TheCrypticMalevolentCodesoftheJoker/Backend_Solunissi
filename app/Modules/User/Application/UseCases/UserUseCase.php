<?php

namespace Modules\User\Application\UseCases;

use Modules\User\Domain\Interfaces\UserInterface;
use Modules\User\Application\DTOs\UserCreateDTO;
use Modules\User\Application\DTOs\UserDetailDTO;
use Modules\User\Application\DTOs\UserListDTO;
use Modules\User\Application\DTOs\UserUpdateDTO;
use Modules\User\Domain\Entities\UserEntity;

class UserUseCase
{
    private UserInterface $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-//
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-//
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-//

    public function ListUsers(): array
    {
        $users = $this->userInterface->ListUsers();

        if (empty($users)) {
            throw new \Exception("No hay usuarios registrados", 404);
        }

        $dtos = [];
        foreach ($users as $user) {
            $dtos[] = new UserListDTO(
                $user->usuarioID,
                $user->nombre,
                $user->apellidos,
                $user->telefono,
                $user->email,
                $user->estado,
                $user->nombreRol,
                $user->createdAt
            );
        }
        return $dtos;
    }

    public function createUser(UserCreateDTO $userCreateDTO): UserDetailDTO
    {
        $userCreateDTO->contrasena = bcrypt($userCreateDTO->contrasena);
        $userEntity = new UserEntity(
            usuarioID: 0,
            nombre: $userCreateDTO->nombre,
            apellidos: $userCreateDTO->apellidos,
            telefono: $userCreateDTO->telefono,
            email: $userCreateDTO->email,
            contrasena: $userCreateDTO->contrasena,
            estado: true,
            rolID: $userCreateDTO->rolId,
            nombreRol: null,
            ultimoLogin: null,
            rememberToken: null,
            createdAt: null,
            updatedAt: null
        );
        $createUser = $this->userInterface->createUser($userEntity);
        return new UserDetailDTO(
            $createUser->usuarioID,
            $createUser->nombre,
            $createUser->apellidos,
            $createUser->telefono,
            $createUser->email,
            $createUser->contrasena,
            $createUser->estado,
            $createUser->rolID,
            $createUser->nombreRol,
            $createUser->ultimoLogin,
            $createUser->createdAt,
            $createUser->updatedAt
        );
    }

    public function DetailUser(int $id): UserDetailDTO
    {
        $usuario = $this->userInterface->DetailUser($id);

        if (!$usuario) {
            throw new \Exception("Usuario no encontrado", 404);
        }

        return new UserDetailDTO(
            $usuario->usuarioID,
            $usuario->nombre,
            $usuario->apellidos,
            $usuario->telefono,
            $usuario->email,
            $usuario->contrasena,
            $usuario->estado,
            $usuario->rolID,
            $usuario->nombreRol,
            $usuario->ultimoLogin,
            $usuario->createdAt,
            $usuario->updatedAt,
        );
    }

    public function updateUser(UserUpdateDTO $userUpdateDTO): UserDetailDTO
    {
        $userUpdateDTO->contrasena = bcrypt($userUpdateDTO->contrasena);

        $userEntity = new UserEntity(
            usuarioID: $userUpdateDTO->usuarioID,
            nombre: $userUpdateDTO->nombre,
            apellidos: $userUpdateDTO->apellidos,
            telefono: $userUpdateDTO->telefono,
            email: $userUpdateDTO->email,
            contrasena: $userUpdateDTO->contrasena,
            estado: $userUpdateDTO->estado,
            rolID: $userUpdateDTO->rolId,
            nombreRol: null,
            ultimoLogin: null,
            rememberToken: null,
            createdAt: null,
            updatedAt: null
        );

        $updatedUser = $this->userInterface->updateUser($userEntity);

        return new UserDetailDTO(
            $updatedUser->usuarioID,
            $updatedUser->nombre,
            $updatedUser->apellidos,
            $updatedUser->telefono,
            $updatedUser->email,
            $updatedUser->contrasena,
            $updatedUser->estado,
            $updatedUser->rolID,
            $updatedUser->nombreRol,
            $updatedUser->ultimoLogin,
            $updatedUser->createdAt,
            $updatedUser->updatedAt
        );
    }

    public function deleteUser(int $id): UserDetailDTO
    {
        $user = $this->userInterface->DetailUser($id);
        if (!$user) {
            throw new \Exception("Usuario no encontrado", 404);
        }

        if (!$user->estado) {
            throw new \Exception("El usuario {$user->nombre} ya se encuentra desactivado", 400);
        }

        $user->desactivar();

        $this->userInterface->updateUser($user);

        return new UserDetailDTO(
            $user->usuarioID,
            $user->nombre,
            $user->apellidos,
            $user->telefono,
            $user->email,
            $user->contrasena,
            $user->estado,
            $user->rolID,
            $user->nombreRol,
            $user->ultimoLogin,
            $user->createdAt,
            $user->updatedAt,
        );
    }
}
