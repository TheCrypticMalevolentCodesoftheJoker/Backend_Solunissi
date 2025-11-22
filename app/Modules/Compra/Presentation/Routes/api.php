<?php

use Illuminate\Support\Facades\Route;
use Modules\Compra\Presentation\Controllers\ContizacionController;
use Modules\Compra\Presentation\Controllers\OrdenCompraController;
use Modules\Compra\Presentation\Controllers\ProveedorController;
use Modules\Compra\Presentation\Controllers\SolicitudCompraController;


Route::prefix('compra')->group(function () {
    // Compras
    Route::get('/solicitud-compra', [SolicitudCompraController::class, 'index']);
    Route::get('/solicitud-compra/{id}', [SolicitudCompraController::class, 'show']);

    // proveedor
    Route::get('/proveedor', [ProveedorController::class, 'index']);
    Route::post('/proveedor', [ProveedorController::class, 'store']);
    Route::get('/proveedor/{id}', [ProveedorController::class, 'show']);

    // Cotizacion
    Route::get('/cotizacion', [ContizacionController::class, 'index']);
    Route::post('/cotizacion', [ContizacionController::class, 'store']);
    Route::get('/cotizacion/{id}', [ContizacionController::class, 'show']);
    Route::get('/cotizacion/{id}/solicitud-compra', [ContizacionController::class, 'showByIdSolicitudCompra']);

    // Orden Compra
    Route::get('/orden-compra', [OrdenCompraController::class, 'index']);
    Route::post('/orden-compra/{id}', [OrdenCompraController::class, 'store']);
    Route::get('/orden-compra/{id}', [OrdenCompraController::class, 'show']);

});
