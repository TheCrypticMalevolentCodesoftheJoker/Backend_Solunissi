<?php

namespace Tests\Unit;

use Modules\User\Domain\Entities\UserEntity;
use Tests\TestCase;
use Modules\User\Infrastructure\Repositories\UserRepository;

class UserRepositoryTest extends TestCase
{
    public function test_Repository()
    {
        $repo = new UserRepository();
        $usuarios = $repo->ListUsers();

        print_r($usuarios);

        $this->assertIsArray($usuarios);
        $this->assertNotEmpty($usuarios);
        $this->assertInstanceOf(UserEntity::class, $usuarios[0]);

    }
}

// php artisan test --filter=UserRepositoryTest
