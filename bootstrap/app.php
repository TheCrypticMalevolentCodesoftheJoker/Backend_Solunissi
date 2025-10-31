<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    // Registra las rutas principales de la aplicación (web, consola y health-check).
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    // Registra los Service Providers adicionales (servicios propios o de terceros).
    ->withProviders([
        Modules\Autenticacion\Infrastructure\Providers\AutenticacionServiceProvider::class,
    ])

    // Define middleware globales que procesan cada request.
    ->withMiddleware(function (Middleware $middleware): void {  
    })

    // Configura el manejo global de errores y excepciones.
    ->withExceptions(function (Exceptions $exceptions): void {
    })

    // Devuelve la aplicación lista para ser ejecutada.
    ->create();
