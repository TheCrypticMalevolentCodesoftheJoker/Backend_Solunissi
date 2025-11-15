<?php

use Illuminate\Support\Facades\Route;
use Modules\Proyecto\Presentation\Controllers\ProyectoController;

Route::prefix('proyecto')->group(function () {

    Route::get('/', [ProyectoController::class, 'index']);
    Route::get('/{id}', [ProyectoController::class, 'show']);
    Route::put('/{id}', [ProyectoController::class, 'update']);
    Route::post('/{id}/finalizar', [ProyectoController::class, 'finalizarProyecto']);
});
