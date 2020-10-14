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
Route::get('/rol', function () {
    return view('usuarios.rol');
});
Route::get('/usuario', function () {
    return view('usuarios.usuario');
});
Route::get('/permiso', function () {
    return view('usuarios.permiso');
});
Route::get('/vue', function () {
    return view('contenido.contenido');
});

Route::get('/sucursal', 'SucursalController@index');
<<<<<<< HEAD
Route::post('/sucursal/registrar', 'SucursalController@store');
=======
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
>>>>>>> 5c86d1baadd9c0378968dd7ec3f2bbc0e2d78415
