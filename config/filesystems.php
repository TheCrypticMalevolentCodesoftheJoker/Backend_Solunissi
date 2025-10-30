<?php

return [

    /* --------------------------------------------------------------------------
    Disco Predeterminado del Sistema de Archivos
    -------------------------------------------------------------------------- */
    'default' => env('FILESYSTEM_DISK', 'local'),

    /* --------------------------------------------------------------------------
    Discos del Sistema de Archivos
    -------------------------------------------------------------------------- */
    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
            'report' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],
    ],

    /* --------------------------------------------------------------------------
    Enlaces Simbólicosa
    -------------------------------------------------------------------------- */
    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
