<?php

namespace Modules\Autenticacion\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Autenticacion\Domain\Interfaces\UserInterface;
use Modules\Autenticacion\Infrastructure\Repositories\UserRepository;

class AutenticacionServiceProvider extends ServiceProvider
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
                $this->loadRoutesFrom(__DIR__ . '/../../Presentation/Routes/api.php');
            });
    }
}
