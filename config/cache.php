<?php

use Illuminate\Support\Str;

return [
    /* --------------------------------------------------------------------------
    Store por Defecto
    -------------------------------------------------------------------------- */
    'default' => env('CACHE_STORE', 'file'),

    /* --------------------------------------------------------------------------
    Configuración de Stores Disponibles
    -------------------------------------------------------------------------- */
    'stores' => [
        'file' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/data'),
            'lock_path' => storage_path('framework/cache/data'),
        ]
    ],

    /* --------------------------------------------------------------------------
    Prefijo para las Llaves de Cache
    -------------------------------------------------------------------------- */
    'prefix' => env('CACHE_PREFIX', Str::slug((string) env('APP_NAME', 'laravel')).'-cache-'),

];
