<?php

namespace Modules\User\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\User\Domain\Interfaces\UserInterface;
use Modules\User\Infrastructure\Repositories\UserRepository;

class UserServiceProvider extends ServiceProvider
{
    public function register(): void {
        $this->app->bind(UserInterface::class, UserRepository::class);
    }

    public function boot(): void
    {
        $router = $this->app['router'];
        $router->prefix('api')
            ->middleware(['api'])
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/../../Presentation/Routes/User_api.php');
            });
    }
}
