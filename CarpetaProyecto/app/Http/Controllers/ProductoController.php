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
            $productos = Producto::join('proveedores', 'productos.idProveedor', '=', 'proveedores.id')
                ->join('ivas', 'productos.idIva', '=', 'ivas.id')
                ->select('productos.id', 'productos.nombre', 'productos.precio', 'productos.estado', 'productos.idProveedor', 'proveedores.nombre as proveedor', 'ivas.porcentaje')
                ->orderBy('productos.id', 'desc')
                ->paginate(10);
        } else {
            $productos = Producto::join('proveedores', 'productos.id', '=', 'proveedores.id')
                ->select('productos.id', 'productos.nombre', 'productos.precio', 'productos.estado', 'proveedores.nombre as proveedor', 'ivas.porcentaje')
                ->where("productos.".$criterio, 'like', '%' . $buscar . '%')
                ->orderBy('productos.id', 'desc')
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

    public function selectProveedores()
    {
        $proveedores = Proveedor::where('estado', '=', '1')
            ->select('id', 'nombre as proveedor')->orderBy('nombre', 'asc')->get();
        return $proveedores;
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
        $iva = Iva::select('id')->get()->last();
        $producto = new Producto();
        $producto->idProveedor = $request->idProveedor;
        $producto->idIva = $iva->id;
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->estado = '1';
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
        $iva = Iva::select('id')->get()->last();
        $producto = Producto::findOrFail($request->id);
        $producto->idProveedor = $request->idProveedor;
        $producto->idIva = $iva->id;
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->estado = '1';
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
