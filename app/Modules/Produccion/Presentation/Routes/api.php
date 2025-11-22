<?php

use Illuminate\Support\Facades\Route;
use Modules\Produccion\Presentation\Controllers\ProyectoAvanceController;
use Modules\Produccion\Presentation\Controllers\ProyectoIncidenciaController;
use Modules\Produccion\Presentation\Controllers\ProyectoMaterialController;
use Modules\Produccion\Presentation\Controllers\ProyectoSolicitudMaterialController;
use Modules\Produccion\Presentation\Controllers\ProyectoSoMaPendienteController;

Route::prefix('produccion')->group(function () {
    // Proyecto materiales
    Route::get('/proyecto-material', [ProyectoMaterialController::class, 'index']);
    Route::post('/proyecto-material', [ProyectoMaterialController::class, 'store']);
    Route::get('/proyecto-material/{id}', [ProyectoMaterialController::class, 'show']);

    // Solicitar Materiales
    Route::get('/solicitud-material', [ProyectoSolicitudMaterialController::class, 'index']);
    Route::post('/solicitud-material', [ProyectoSolicitudMaterialController::class, 'store']);
    Route::get('/solicitud-material/{id}', [ProyectoSolicitudMaterialController::class, 'show']);

    // Proyecto avance
    Route::get('/proyecto-avance', [ProyectoAvanceController::class, 'index']);
    Route::post('/proyecto-avance', [ProyectoAvanceController::class, 'store']);
    Route::get('/proyecto-avance/{id}', [ProyectoAvanceController::class, 'show']);
    Route::get('/proyecto-avance/{id}/proyecto', [ProyectoAvanceController::class, 'showGetByIdProyecto']);

    // Proyecto incidencias
    Route::get('/proyecto-incidencia', [ProyectoIncidenciaController::class, 'index']);
    Route::post('/proyecto-incidencia', [ProyectoIncidenciaController::class, 'store']);
    Route::get('/proyecto-incidencia/{id}', [ProyectoIncidenciaController::class, 'show']);
    Route::get('/proyecto-incidencia/{id}/proyecto', [ProyectoIncidenciaController::class, 'showGetByIdProyecto']);
});
