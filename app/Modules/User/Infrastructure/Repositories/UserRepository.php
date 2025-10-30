<?php

namespace Modules\User\Infrastructure\Repositories;

use Modules\User\Domain\Interfaces\UserInterface;
use Modules\User\Domain\Entities\UserEntity;
use App\Models\TblUsuario;

class UserRepository implements UserInterface
{

    public function ListUsers(): array
    {
        return TblUsuario::all()->map(function ($users) {
            return new UserEntity(
                $users->UsuarioID,
                $users->Nombre,
                $users->Apellidos,
                $users->Telefono,
                $users->Email,
                $users->Contrasena,
                $users->Estado,
                $users->RolID,
                $users->tbl_rol->NombreRol,
                $users->UltimoLogin,
                $users->remember_token,
                $users->created_at,
                $users->updatedAt
            );
        })->all();
    }

    public function createUser(UserEntity $userEntity): UserEntity
    {
        $user = new TblUsuario();
        $user->Nombre        = $userEntity->nombre;
        $user->Apellidos     = $userEntity->apellidos;
        $user->Telefono      = $userEntity->telefono;
        $user->Email         = $userEntity->email;
        $user->Contrasena    = $userEntity->contrasena;
        $user->Estado        = $userEntity->estado;
        $user->RolID         = $userEntity->rolID;

        $user->save();
        $user->load('tbl_rol');
        return new UserEntity(
            $user->UsuarioID,
            $user->Nombre,
            $user->Apellidos,
            $user->Telefono,
            $user->Email,
            $user->Contrasena,
            $user->Estado,
            $user->RolID,
            $user->tbl_rol->NombreRol,
            $user->UltimoLogin,
            $user->remember_token,
            $user->created_at,
            $user->updated_at
        );
    }

    public function DetailUser(int $id): ?UserEntity
    {
        $user = TblUsuario::find($id);

        if (!$user) {
            return null;
        }

        return new UserEntity(
            $user->UsuarioID,
            $user->Nombre,
            $user->Apellidos,
            $user->Telefono,
            $user->Email,
            $user->Contrasena,
            $user->Estado,
            $user->RolID,
            $user->tbl_rol->NombreRol,
            $user->UltimoLogin,
            $user->remember_token,
            $user->created_at,
            $user->updated_at
        );
    }

    public function updateUser(UserEntity $userEntity): UserEntity
    {
        $user = TblUsuario::find($userEntity->usuarioID);
        $user->Nombre       = $userEntity->nombre;
        $user->Apellidos    = $userEntity->apellidos;
        $user->Telefono     = $userEntity->telefono;
        $user->Email        = $userEntity->email;
        $user->Contrasena   = $userEntity->contrasena;
        $user->Estado       = $userEntity->estado;
        $user->RolID        = $userEntity->rolID;
        $user->save();
        return new UserEntity(
            $user->UsuarioID,
            $user->Nombre,
            $user->Apellidos,
            $user->Telefono,
            $user->Email,
            $user->Contrasena,
            $user->Estado,
            $user->RolID,
            $user->tbl_rol->NombreRol,
            $user->UltimoLogin,
            $user->remember_token,
            $user->created_at,
            $user->updated_at
        );
    }
}
