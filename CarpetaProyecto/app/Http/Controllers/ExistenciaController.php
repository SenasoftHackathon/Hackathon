<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Existencia;

class ExistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $existencia = Existencia::join('sucursales','existencias.idSucursal','=','sucursales.id')
            ->join('productos','existencias.idProducto','=','productos.id')
            ->select('existencias.id','existencias.idSucursal','existencias.idProducto','sucursales.nombre as nombre_sucursal','productos.nombre as nombre_producto','existencias.stockBodega','existencias.stockScursal')
            ->orderBy('existencias.id', 'desc')->paginate(3);
        }
        else{
            $existencia = Existencia::join('sucursales','existencias.idSucursal','=','sucursales.id')
            ->join('productos','existencias.idProducto','=','productos.id')
            ->select('existencias.id','existencias.idSucursal','existencias.idProducto','sucursales.nombre as nombre_sucursal','productos.nombre as nombre_producto','existencias.stockBodega','existencias.stockScursal')
            ->where('existencias.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('existencias.id', 'desc')->paginate(3);
        }
        

        return [
            'pagination' => [
                'total'        => $existencia->total(),
                'current_page' => $existencia->currentPage(),
                'per_page'     => $existencia->perPage(),
                'last_page'    => $existencia->lastPage(),
                'from'         => $existencia->firstItem(),
                'to'           => $existencia->lastItem(),
            ],
            'existencias' => $existencia
        ];

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
