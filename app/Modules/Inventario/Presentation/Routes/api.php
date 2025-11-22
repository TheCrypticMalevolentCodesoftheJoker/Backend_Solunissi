<?php

use Illuminate\Support\Facades\Route;
use Modules\Inventario\Presentation\Controllers\AlmacenController;
use Modules\Inventario\Presentation\Controllers\InventarioMovimientoController;
use Modules\Inventario\Presentation\Controllers\MaterialController;

Route::prefix('inventario')->group(function () {
    // Almacen
    Route::get('/almacen', [AlmacenController::class, 'index']);
    Route::post('/almacen', [AlmacenController::class, 'store']);
    Route::get('/almacen/{id}', [AlmacenController::class, 'show']);
    // Material
    Route::get('/material', [MaterialController::class, 'index']);
    Route::post('/material', [MaterialController::class, 'store']);
    Route::get('/material/{id}', [MaterialController::class, 'show']);

    
    // Movimietno material
    Route::post('/', [InventarioMovimientoController::class, 'store']);
});
