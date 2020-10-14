<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $productos = Producto::all();
        return $productos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $producto = new Producto();
        $producto->idProveedor = $request->idProveedor;
        $producto->idIva = $request->idIva;
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->estado = $request->estado;
        $producto->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $producto = Producto::findOrFail($request->id);
        $producto->idProveedor = $request->idProveedor;
        $producto->idIva = $request->idIva;
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->estado = $request->estado;
        $producto->save();
    }

    public function desactivar(Request $request)
    {
        $producto = Producto::findOrFail($request->id);
        $producto->estado = '0';
        $producto->save();
    }

    public function activar(Request $request)
    {
        $producto = Producto::findOrFail($request->id);
        $producto->estado = '1';
        $producto->save();
    }
}
