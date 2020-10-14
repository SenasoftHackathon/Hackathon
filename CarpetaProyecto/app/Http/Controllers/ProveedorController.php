<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;

class ProveedorController extends Controller
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
            $proveedores = Proveedor::orderBy('id', 'desc')->paginate(10);
        }else{
            $proveedores = Proveedor::where($criterio, 'like', '%'.$buscar.'%')->orderBy('id', 'desc')->paginate(10);
        }
        return [
            'pagination' => [
                'total'        => $proveedores->total(),
                'current_page' => $proveedores->currentPage(),
                'per_page'     => $proveedores->perPage(),
                'last_page'    => $proveedores->lastPage(),
                'from'         => $proveedores->firstItem(),
                'to'           => $proveedores->lastItem(),
            ],
            'proveedores' => $proveedores
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
        $proveedor = new Proveedor();
        $proveedor->nombre = $request->nombre;
        $proveedor->direccion = $request->direccion;
        $proveedor->correo = $request->correo;
        $proveedor->estado = '1';
        $proveedor->save();
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
        $proveedor = Proveedor::findOrFail($request->id);
        $proveedor->nombre = $request->nombre;
        $proveedor->direccion = $request->direccion;
        $proveedor->correo = $request->correo;
        $proveedor->estado = '1';
        $proveedor->save();
    }

    public function desactivarProveedor(Request $request)
    {
        $proveedor = Proveedor::findOrFail($request->id);
        $proveedor->estado = '0';
        $proveedor->save();
    }

    public function activarProveedor(Request $request)
    {
        $proveedor = Proveedor::findOrFail($request->id);
        $proveedor->estado = '1';
        $proveedor->save();
    }
}
