<?php

namespace Modules\Shared\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class ModulesLoaderServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $router = $this->app['router'];
        $router->prefix('api')
            ->middleware(['api'])
            ->group(function () {
                $modulesPath = app_path('Modules');

                if (File::exists($modulesPath)) {
                    foreach (File::directories($modulesPath) as $moduleDir) {
                        $routesFile = $moduleDir . '/Presentation/Routes/api.php';
                        if (File::exists($routesFile)) {
                            $this->loadRoutesFrom($routesFile);
                        }
                    }
                }
            });
    }
}
