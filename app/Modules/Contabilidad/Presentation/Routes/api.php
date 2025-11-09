<?php

use Illuminate\Support\Facades\Route;
use Modules\Contabilidad\Presentation\Controllers\CentroCostoController;
use Modules\Contabilidad\Presentation\Controllers\CuentaContableController;
use Modules\Contabilidad\Presentation\Controllers\TipoTransaccionController;
use Modules\Contabilidad\Presentation\Controllers\TransaccionContableController;

Route::prefix('contabilidad')->group(function () {
    Route::get('/centros-costo', [CentroCostoController::class, 'index']);
    Route::get('/tipos-transaccion', [TipoTransaccionController::class, 'index']);
    Route::get('/cuentas-contables', [CuentaContableController::class, 'index']);


    Route::post('/regitrar', [TransaccionContableController::class, 'store']);
    Route::get('/colsutar', [TransaccionContableController::class, 'index']);
    Route::get('/reporte', [TransaccionContableController::class, 'reportePDF']);
});