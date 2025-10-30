<?php

namespace Tests\Unit;

use Modules\User\Application\UseCases\UserUseCase;
use Modules\User\Infrastructure\Repositories\UserRepository;
use Tests\TestCase;


class UserUseCaseTest extends TestCase
{
    public function test_UseCase()
    {
        $repo = new UserRepository();
        $useCase = new UserUseCase($repo);

        $usuarios = $useCase->ListaDeUsuarios();

        print_r($usuarios); 
    }
}

// php artisan test --filter=UserUseCaseTest
