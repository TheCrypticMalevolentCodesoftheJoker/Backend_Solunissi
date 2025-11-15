<?php

use Illuminate\Support\Facades\Route;
use Modules\CRM\Presentation\Controllers\LeadController;
use Modules\CRM\Presentation\Controllers\ClienteController;
use Modules\CRM\Presentation\Controllers\LeadComunicacionController;
use Modules\CRM\Presentation\Controllers\ClienteIncidenciaController;

Route::prefix('crm')->group(function () {
    // Lead
    Route::get('/lead', [LeadController::class, 'index']);
    Route::post('/lead', [LeadController::class, 'store']);
    Route::get('/lead/{id}', [LeadController::class, 'show']);

    // Comunicacion Lead
    Route::get('/lead-comunicacion', [LeadComunicacionController::class, 'index']);
    Route::post('/lead-comunicacion', [LeadComunicacionController::class, 'store']);
    Route::get('/lead-comunicacion/{id}', [LeadComunicacionController::class, 'show']);

    // Cliente
    Route::get('/cliente', [ClienteController::class, 'index']);
    Route::post('/cliente', [ClienteController::class, 'store']);
    Route::get('/cliente/{id}', [ClienteController::class, 'show']);

    // Incidencias Cliente
    Route::get('/cliente-incidencia', [ClienteIncidenciaController::class, 'index']);
    Route::post('/cliente-incidencia', [ClienteIncidenciaController::class, 'store']);
    Route::get('/cliente-incidencia/{id}', [ClienteIncidenciaController::class, 'show']);
});
