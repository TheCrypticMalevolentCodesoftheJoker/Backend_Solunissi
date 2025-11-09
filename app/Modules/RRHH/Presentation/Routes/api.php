<?php

use Illuminate\Support\Facades\Route;
use Modules\RRHH\Presentation\Controllers\BoletaPagoController;
use Modules\RRHH\Presentation\Controllers\CargoController;
use Modules\RRHH\Presentation\Controllers\EmpleadoController;
use Modules\RRHH\Presentation\Controllers\NominaController;

Route::prefix('rrhh')->group(function () {
    // Cargos
    Route::get('/cargos', [CargoController::class, 'index']);

    // Empleados
    Route::get('/empleados', [EmpleadoController::class, 'index']);
    Route::post('empleados', [EmpleadoController::class, 'store']);
    Route::post('/equipos-operativos', [EmpleadoController::class, 'asignarEquipoOperativo']);
    Route::get('/equipos-operativos', [EmpleadoController::class, 'consultarEquipoOperativo']);
    Route::post('/asistencia', [EmpleadoController::class, 'registrarAsistencia']);
    Route::get('/asistencia', [EmpleadoController::class, 'consultarAsistencia']);
    // Nomina
    Route::get('/nomina', [NominaController::class, 'index']);
    Route::post('/nomina', [NominaController::class, 'store']);
    Route::post('/nomina/{id}/cerrar', [NominaController::class, 'cerrarNomina']);
    Route::get('/nomina/{id}/reporte', [NominaController::class, 'reportePDF']);
    // Boleta pago
    Route::get('/boleta-pago', [BoletaPagoController::class, 'index']);
    Route::post('/boleta-pago', [BoletaPagoController::class, 'store']);
});
