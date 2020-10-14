<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura;

class FacturaController extends Controller
{
    public function index(Request $request){
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if ($buscar == "") {
            $facturas = Factura::orderBy('id','desc')->paginate(5);
        }else{
            $facturas = Factura::where($criterio, 'like', '%'.$buscar.'%')->orderBy('id', 'desc')->paginate(10);
        }
        return [
            'pagination' => [
                'total'        => $facturas->total(),
                'current_page' => $facturas->currentPage(),
                'per_page'     => $facturas->perPage(),
                'last_page'    => $facturas->lastPage(),
                'from'         => $facturas->firstItem(),
                'to'           => $facturas->lastItem(),
            ],
            'facturas' => $facturas
        ];
    }
}
