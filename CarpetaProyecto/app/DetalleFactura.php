<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    protected $table = "detalle_Facturas";

    protected $fillable = [
        'idFactura', 'idProducto', 'cantidad', 'valorUnitario',
    ];

    public $timestamps = false;
}
