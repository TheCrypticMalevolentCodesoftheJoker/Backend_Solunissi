<?php

namespace Modules\User\Domain\Interfaces;

use Modules\User\Domain\Entities\UserEntity;

interface UserInterface
{
    public function ListUsers(): array;
    public function createUser(UserEntity $userEntity): UserEntity;
    public function DetailUser(int $id): ?UserEntity;
    public function updateUser(UserEntity $userEntity): UserEntity;
}
