<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});
Route::get('/autenticación', function () {
    return view('autenticación');
});
Route::get('/contabilidad', function () {
    return view('contabilidad');
});
Route::get('/rrhh', function () {
    return view('rrhh');
});