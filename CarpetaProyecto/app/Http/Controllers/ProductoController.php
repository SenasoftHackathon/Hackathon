<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Producto;
use App\Proveedor;
use App\Iva;
use App\Sucursal;
use App\Existencia;

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
                ->select('productos.id', 'productos.nombre', 'productos.precio', 'productos.stockBodega',  'productos.estado', 'productos.idProveedor', 'proveedores.nombre as proveedor', 'ivas.porcentaje')
                ->orderBy('productos.id', 'desc')
                ->paginate(10);
        } else {
            $productos = Producto::join('proveedores', 'productos.id', '=', 'proveedores.id')
                ->select('productos.id', 'productos.nombre', 'productos.precio', 'productos.stockBodega',  'productos.estado', 'proveedores.nombre as proveedor', 'ivas.porcentaje')
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
        $producto->stockBodega = $request->stockBodega;
        $producto->estado = '1';
        $producto->save();

        $productoRegistrado = Producto::select('id')->get()->last();
        $sucursales = Sucursal::all();
        foreach ($sucursales as $sucursal) {
            $existencia = new Existencia();
            $existencia->idSucursal = $sucursal->id;
            $existencia->idProducto = $productoRegistrado->id;
            $existencia->stockSucursal = 0;
            $existencia->save();
        }
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
        $producto->stockBodega = $request->stockBodega;
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

    public function buscarProductoFactura(Request $request){
        if(!$request->ajax()) return redirect('/');
        $filtro = $request->filtro;

        $productos = Producto::join('existencias', 'existencias.idProducto', '=', 'productos.id')
        ->select('productos.id', 'productos.nombre', 'existencias.stockSucursal','productos.precio')
        ->where('productos.nombre','=',$filtro)
        ->orderBy('productos.nombre', 'asc')->take(1)->get();

        return ['productos' => $productos];
    }

    public function listarProductoFactura(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $productos = Productos::join('ivas', 'productos.idIva','=','ivas.id')
            ->select('productos.id','productos.nombre','productos.precio','ivas.porcentaje','productos.estado')
            //->where('productos.stock','>','0')
            ->orderBy('productos.id', 'desc')->paginate(10);
        }
        else{
            $productos = Productos::join('ivas', 'productos.idIva','=','ivas.id')
            ->select('productos.id','productos.nombre','productos.precio','ivas.porcentaje','productos.estado')
            ->where('productos.'.$criterio, 'like', '%'. $buscar . '%')
            //->where('productos.stock','>','0')
            ->orderBy('productos.id', 'desc')->paginate(10);
        }
        

        return ['productos' => $productos];
    }
}
