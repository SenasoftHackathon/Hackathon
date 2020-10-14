<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permiso;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permisos = Permiso::all();
        return $Permisos;
    }
}
