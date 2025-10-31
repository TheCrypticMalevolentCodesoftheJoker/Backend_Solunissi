<?php

namespace Modules\Autenticacion\Domain\Interfaces;

use Modules\Autenticacion\Domain\Entities\UserEntity;

interface UserInterface
{
    public function ListUsers(): array;
    public function createUser(UserEntity $userEntity): UserEntity;
    public function DetailUser(int $id): ?UserEntity;
    public function updateUser(UserEntity $userEntity): UserEntity;

    public function findByEmail(string $email): ?UserEntity;
    public function updateLastLogin(int $usuarioID, \DateTime $fecha): bool;

}
