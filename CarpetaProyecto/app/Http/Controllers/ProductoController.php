<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Producto;
use App\Proveedor;
use App\Iva;

class ProductoController extends Controller
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
        if ($buscar == "") {
            $productos = Producto::join('proveedores', 'productos.id' , '=', 'proveedores.id')
            ->select('productos.id', 'productos.nombre', 'productos.precio', 'productos.estado', 'proveedores.nombre as nombre_p', 'ivas.procentaje')
            ->orderBy('id', 'desc')
            ->paginate(10);
        }else{
            $productos = Producto::join('proveedores', 'productos.id' , '=', 'proveedores.id')
            ->select('productos.id', 'productos.nombre', 'productos.precio', 'productos.estado', 'proveedores.nombre as nombre_p', 'ivas.procentaje')
            ->where($criterio, 'like', '%'.$buscar.'%')->orderBy('id', 'desc')
            ->paginate(10);
        }
        return [
            'pagination' => [
                'total'        => $productos->total(),
                'current_page' => $productos->currentPage(),
                'per_page'     => $productos->perPage(),
                'last_page'    => $productos->lastPage(),
                'from'         => $productos->firstItem(),
                'to'           => $productos->lastItem(),
            ],
            'productos' => $productos
        ];
    }

    public function selectProveedores(){
        $proveedores = Proveedor::where('estado', '=', '1')
        ->select('id', 'nombre')->orderBy('nombre','asc')->get();
        return ['proveedores' => $proveedores];
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
        $iva = DB::table('ivas')->select('procentaje')->order_by('id', 'desc')->first();
        $producto = Producto::findOrFail($request->id);
        $producto->idProveedor = $request->idProveedor;
        $producto->idIva = $iva;
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->save();
    }

    public function desactivarProducto(Request $request)
    {
        $producto = Producto::findOrFail($request->id);
        $producto->estado = '0';
        $producto->save();
    }

    public function activarProducto(Request $request)
    {
        $producto = Producto::findOrFail($request->id);
        $producto->estado = '1';
        $producto->save();
    }
}
