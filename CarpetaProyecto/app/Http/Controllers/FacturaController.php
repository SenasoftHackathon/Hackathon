<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura;
use App\User;
use App\DetalleFactura;
use Carbon\Carbon;

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

    public function store(Request $request)
    {
        $factura = new Factura();
        $factura->idUsuario = 4;
        //$factura->idusuario = \Auth::user()->id;
        $factura->fechaCreacion = Carbon::now('America/Lima');
        $factura->estado = 1;
        $factura->save();
        $detalles = $request->data;//Array de detalles
        //Recorro los elementos del array
        
        foreach($detalles as $ep=>$det)
        {
            $detalle = new DetalleFactura();
            $detalle->idFactura = $factura->id;
            $detalle->idProducto = $det['idProducto'];
            $detalle->cantidad = $det['cantidad'];
            $detalle->valorUnitario = $det['precio'];      
            $detalle->save();
        }  
        return response()->json($factura->id);
    }

    public function obtenerDetalles(Request $request){
 
        $id = $request->id;
        $detalles = DetalleFactura::join('productos','detalle_facturas.idProducto','=','productos.id')
        ->select('detalle_facturas.cantidad','detalle_facturas.precio',
        'productos.nombre as producto')
        ->where('detalle_facturas.idFactura','=',$id)
        ->orderBy('detalle_facturas.id', 'desc')->get();
        
        return ['detalles' => $detalles];
    }

    public function obtenerEncabezado(Request $request){
 
        $id = $request->id;
        $factura = Factura::join('users','facturas.idUsuario','=','users.id')
        ->select('facturas.id','facturas.fechaCreacion','facturas.total',
        'facturas.estado','users.usuario')
        ->where('facturas.id','=',$id)
        ->orderBy('facturas.id', 'desc')->take(1)->get();
        
        return ['factura' => $factura];
    }

}
