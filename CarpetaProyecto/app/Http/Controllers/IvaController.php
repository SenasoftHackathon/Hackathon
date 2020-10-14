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
    public function index()
    {
        //
        $ivas = Iva::all();
        return $ivas;
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
