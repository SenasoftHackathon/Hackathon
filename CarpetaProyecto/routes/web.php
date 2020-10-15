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
// Route::get('/', function () {
//     return view('admin.admin');
// });

Route::get('/bodega', function () {
    return view('sucursales.bodega');
});
Route::get('/producto', function () {
    return view('sucursales.producto');
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
Route::get('/', function () {
    return view('contenido.contenido');
});

Route::get('/sucursal', 'SucursalController@index');
Route::post('/sucursal/registrar', 'SucursalController@store');
Route::put('/sucursal/actualizar', 'SucursalController@update');

Route::get('/proveedor', 'ProveedorController@index');
Route::post('/proveedor/registrar', 'ProveedorController@store');
Route::put('/proveedor/actualizar', 'ProveedorController@update');
Route::put('/proveedor/activar', 'ProveedorController@activarProveedor');
Route::put('/proveedor/desactivar', 'ProveedorController@desactivarProveedor');


Route::get('/producto', 'ProductoController@index');
Route::get('/producto/selectProveedor', 'ProductoController@selectProveedores');
Route::post('/producto/registrar', 'ProductoController@store');
Route::put('/producto/actualizar', 'ProductoController@update');
Route::put('/producto/activar', 'ProductoController@activarProducto');
Route::put('/producto/desactivar', 'ProductoController@desactivarProducto');

Route::get('/iva', 'IvaController@index');
Route::post('/iva/registrar', 'IvaController@store');

Route::get('/facturacion', 'FacturaController@index');
Route::get('/facturacion/selectProducto', 'FacturaController@selectProductos');
Route::post('/facturacion/registrar', 'FacturaController@store');
Route::put('/facturacion/actualizar', 'FacturaController@update');
Route::put('/facturacion/activar', 'FacturaController@activarProducto');
Route::put('/facturacion/desactivar', 'FacturaController@desactivarProducto');

Route::get('/existencia', 'ExistenciaController@index');
//Route::post('/iva/registrar', 'IvaController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
