<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('admin.admin');
});

Route::get('/bodega', function () {
    return view('sucursales.bodega');
});
Route::get('/sucursal', function () {
    return view('sucursales.sucursal');
});
Route::get('/producto', function () {
    return view('sucursales.producto');
});
Route::get('/proveedor', function () {
    return view('sucursales.proveedor');
});
Route::get('/iva', function () {
    return view('configuracion.iva');
});
Route::get('/facturacion', function () {
    return view('facturacion');
});