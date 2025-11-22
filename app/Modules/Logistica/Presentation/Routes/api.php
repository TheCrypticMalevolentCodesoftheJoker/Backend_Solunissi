<?php

use Illuminate\Support\Facades\Route;
use Modules\Logistica\Presentation\Controllers\SolicitudMaterialPendienteController;

Route::prefix('logistica')->group(function () {
    // Solicitud Materiales pendientes
    Route::get('/solicitud-material-pendiente', [SolicitudMaterialPendienteController::class, 'index']);
    Route::get('/solicitud-material-pendiente/{id}', [SolicitudMaterialPendienteController::class, 'show']);

});
