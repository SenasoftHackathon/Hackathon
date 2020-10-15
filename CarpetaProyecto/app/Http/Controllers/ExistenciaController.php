<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Existencia;
use App\Sucursal;
use App\Producto;

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

        if ($buscar == '') {
            $existencia = Existencia::join('sucursales', 'existencias.idSucursal', '=', 'sucursales.id')
                ->join('productos', 'existencias.idProducto', '=', 'productos.id')
                ->select('existencias.id', 'existencias.idSucursal', 'existencias.idProducto', 'sucursales.nombre as nombre_sucursal', 'productos.nombre as nombre_producto', 'existencias.stockSucursal')
                ->orderBy('existencias.id', 'desc')->paginate(10);
        } else {
            $existencia = Existencia::join('sucursales', 'existencias.idSucursal', '=', 'sucursales.id')
                ->join('productos', 'existencias.idProducto', '=', 'productos.id')
                ->select('existencias.id', 'existencias.idSucursal', 'existencias.idProducto', 'sucursales.nombre as nombre_sucursal', 'productos.nombre as nombre_producto', 'existencias.stockSucursal')
                ->where($criterio, 'like', '%' . $buscar . '%')
                ->orderBy('existencias.id', 'desc')->paginate(10);
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

    public function selectSucursal()
    {
        $sucursal = Sucursal::select('id', 'nombre')->orderBy('id', 'desc')->get();
        return $sucursal;
    }

    public function selectProducto()
    {
        $producto = Producto::select('id', 'nombre')->orderBy('id', 'desc')->get();
        return $producto;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*
    public function store(Request $request)
    {
        //
        $existencia = new Existencia();
        $existencia->idSucursal = $request->idSucursal;
        $existencia->idProducto = $request->idProducto;
        $existencia->stockBodega = $request->stockBodega;
        $existencia->stockSucursal = $request->stockSucursal;
        $existencia->save();
    }
    */

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
        $existencia = Existencia::findOrFail($request->id);
        $existencia->stockSucursal = $existencia->stockSucursal + $request->stockSucursal;
        $existencia->save();
    }
}
