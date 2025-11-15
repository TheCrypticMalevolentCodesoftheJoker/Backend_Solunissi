<?php

use Illuminate\Support\Facades\Route;
use Modules\Produccion\Presentation\Controllers\ProyectoAvanceController;
use Modules\Produccion\Presentation\Controllers\ProyectoIncidenciaController;
use Modules\Produccion\Presentation\Controllers\ProyectoMaterialController;
use Modules\Produccion\Presentation\Controllers\ReportesController;
use Modules\Produccion\Presentation\Controllers\SolicitudMaterialController;

Route::prefix('produccion')->group(function () {
    // Proyecto materiales
    Route::get('/proyecto-material', [ProyectoMaterialController::class, 'index']);
    Route::post('/proyecto-material', [ProyectoMaterialController::class, 'store']);
    Route::get('/proyecto-material/{id}', [ProyectoMaterialController::class, 'show']);

    // Solicitar Materiales
    Route::post('/solicitud-material', [SolicitudMaterialController::class, 'store']);

    // Proyecto materiales
    Route::get('/proyecto-avance', [ProyectoAvanceController::class, 'index']);
    Route::post('/proyecto-avance', [ProyectoAvanceController::class, 'store']);
    Route::get('/proyecto-avance/{id}', [ProyectoAvanceController::class, 'show']);

    // Proyecto incidencias
    Route::get('/proyecto-incidencia', [ProyectoIncidenciaController::class, 'index']);
    Route::post('/proyecto-incidencia', [ProyectoIncidenciaController::class, 'store']);
    Route::get('/proyecto-incidencia/{id}', [ProyectoIncidenciaController::class, 'show']);

    // Reportes
    Route::get('/reporte/{id}', [ReportesController::class, 'reportePDF']);
});
