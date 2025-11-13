<?php

use Illuminate\Support\Facades\Route;
use Modules\Compra\Presentation\Controllers\ContizacionController;
use Modules\Compra\Presentation\Controllers\OrdenCompraController;
use Modules\Compra\Presentation\Controllers\SolicitudCompraController;


Route::prefix('compra')->group(function () {
    // Compras
    Route::get('/solicitud-compras', [SolicitudCompraController::class, 'index']);
    Route::post('/solicitud-compras', [SolicitudCompraController::class, 'store']);
    Route::get('/solicitud-compras/{id}', [SolicitudCompraController::class, 'show']);

    // Cotizacion
    Route::get('/cotizaciones', [ContizacionController::class, 'index']);
    Route::post('/cotizaciones', [ContizacionController::class, 'store']);
    Route::get('/cotizaciones/{id}', [ContizacionController::class, 'show']);
    Route::get('/cotizaciones/solicitud/{solicitudId}', [ContizacionController::class, 'showBySolicitud']);

    // Orden Compra
    Route::get('/ordenes-compra', [OrdenCompraController::class, 'index']);
    Route::post('/ordenes-compra', [OrdenCompraController::class, 'store']);
    Route::get('/ordenes-compra/{id}', [OrdenCompraController::class, 'show']);
    Route::post('/ordenes-compra/{id}/aprobar', [OrdenCompraController::class, 'aprobarOrdenCompra']);
    Route::get('/ordenes-compra/{id}/reporte', [OrdenCompraController::class, 'reportePDF']);

});
