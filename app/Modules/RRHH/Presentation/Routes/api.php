<?php

use Illuminate\Support\Facades\Route;
use Modules\RRHH\Presentation\Controllers\CargoController;
use Modules\RRHH\Presentation\Controllers\EmpleadoController;

Route::prefix('rrhh')->group(function () {
    // cargos
    Route::get('/cargos', [CargoController::class, 'index']);

    // empleados
    Route::get('/empleados', [EmpleadoController::class, 'index']);
    Route::post('empleados', [EmpleadoController::class, 'store']);
    Route::post('/equipos-operativos', [EmpleadoController::class, 'asignarEquipoOperativo']);
    Route::get('/equipos-operativos', [EmpleadoController::class, 'consultarEquipoOperativo']);
});
