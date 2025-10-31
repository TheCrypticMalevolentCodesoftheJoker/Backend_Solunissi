<?php

use Illuminate\Support\Facades\Route;
use Modules\Autenticacion\Presentation\Controllers\AutenticacionController;
use Modules\Autenticacion\Presentation\Controllers\UserController;

Route::prefix('auth')->group(function() {
    Route::post('/login', [AutenticacionController::class, 'login']);
});


Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});