<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura;
use App\User;

class FacturaController extends Controller
{
    public function index(Request $request){
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if($criterio=='name'){
            $usuario = User::select('users.id')
            ->where('users.name','like',$buscar);
            $criterio = 'idUsuario';
            $buscar = $buscar;

            if ($buscar == "") {
                $facturas = Factura::join('users','facturas.idUsuario','=','users.id')
                ->select('facturas.id','facturas.idUsuario','facturas.estado','users.name','facturas.fechaCreacion')
                ->where('facturas.'.$criterio,'=',$buscar)
                ->orderBy('facturas.id','desc')->paginate(5);
            }else{
                $facturas = Factura::join('users','facturas.idUsuario','=','users.id')
                ->select('facturas.id','facturas.idUsuario','facturas.estado','users.name','facturas.fechaCreacion')
                ->where('facturas.'.$criterio,'=',$buscar)
                ->orderBy('id', 'desc')->paginate(10);
            }
        }else
        {
            if ($buscar == "") {
                $facturas = Factura::join('users','facturas.idUsuario','=','users.id')
                ->select('facturas.id','facturas.idUsuario','facturas.estado','users.name','facturas.fechaCreacion')
                ->where('facturas.'.$criterio,'like','%'.$buscar.'%')
                ->orderBy('facturas.id','desc')->paginate(5);
            }else{
                $facturas = Factura::where($criterio, 'like', '%'.$buscar.'%')->orderBy('id', 'desc')->paginate(10);
            }
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
