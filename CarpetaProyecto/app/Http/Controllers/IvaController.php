<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Iva;

use Carbon\Carbon;

class IvaController extends Controller
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
            $ivas = Iva::orderBy('id', 'desc')->paginate(5);
        }else{
            $ivas = Iva::where($criterio, 'like', '%'.$buscar.'%')->orderBy('id', 'desc')->paginate(10);
        }
        return [
            'pagination' => [
                'total'        => $ivas->total(),
                'current_page' => $ivas->currentPage(),
                'per_page'     => $ivas->perPage(),
                'last_page'    => $ivas->lastPage(),
                'from'         => $ivas->firstItem(),
                'to'           => $ivas->lastItem(),
            ],
            'ivas' => $ivas
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
        $iva = new Iva();
        $iva->porcentaje = $request->porcentaje;
        $iva->fechaCreacion = Carbon::now('America/Bogota');
        $iva->save();
    }
}
