<?php

return [

    /* --------------------------------------------------------------------------
    Valores predeterminados de Autenticación
    -------------------------------------------------------------------------- */
    'defaults' => [
        'guard' => env('AUTH_GUARD', 'api'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'password_recovery'),
    ],

    /* --------------------------------------------------------------------------
    Guards de Autenticación
    -------------------------------------------------------------------------- */
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'api' => [
            'driver' => 'token',
            'provider' => 'users',
        ],
    ],

    /* --------------------------------------------------------------------------
        Provider de guards
        -------------------------------------------------------------------------- */
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', ), // aqui se pone el modelo de donde se optiene
        ],
    ],

    /* --------------------------------------------------------------------------
    Restablecimiento de Contraseñas
    -------------------------------------------------------------------------- */
    'passwords' => [
        'password_recovery' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,  // duración del token (min)
            'throttle' => 60, // espera entre solicitudes (min)
        ],
    ],

    /* --------------------------------------------------------------------------
    Tiempo de Expiración de Confirmación de Contraseña
    -------------------------------------------------------------------------- */
    // tiempo límite para reconfirmar contraseña en acciones críticas (seg)
    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
