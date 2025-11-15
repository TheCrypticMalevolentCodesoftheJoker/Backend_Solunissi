<?php

use Illuminate\Support\Facades\Route;
use Modules\Venta\Presentation\Controllers\ContratoController;
use Modules\Venta\Presentation\Controllers\ContratoPagoController;
use Modules\Venta\Presentation\Controllers\FacturaController;

Route::prefix('venta')->group(function () {
    // Contrato
    Route::get('/contrato', [ContratoController::class, 'index']);
    Route::post('/contrato', [ContratoController::class, 'store']);
    Route::get('/contrato/{id}', [ContratoController::class, 'show']);

    // Pago contrato
    Route::get('/contrato-pago', [ContratoPagoController::class, 'index']);
    Route::post('/contrato-pago', [ContratoPagoController::class, 'store']);
    Route::get('/contrato-pago/{id}', [ContratoPagoController::class, 'show']);

    // Factura
    Route::get('/factura', [FacturaController::class, 'index']);
    Route::get('/factura/{id}', [FacturaController::class, 'show']);
});
