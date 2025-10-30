<?php

namespace Tests\Unit;

use Tests\TestCase;
use Modules\User\Application\Services\UserService;
use Modules\User\Application\UseCases\UserUseCase;
use Modules\User\Infrastructure\Repositories\UserRepository;

class UserServiceTest extends TestCase
{
    public function test_obtenerUsuarios()
    {
        $repo = new UserRepository();
        $useCase = new UserUseCase($repo);
        $service = new UserService($useCase);

        $usuarios = $service->obtenerUsuarios();
        print_r($usuarios);

        $this->assertIsArray($usuarios);
        $this->assertNotEmpty($usuarios);
    }
}
// php artisan test --filter=UserServiceTest