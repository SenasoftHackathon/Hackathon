<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    protected $table = "detalleFacturas";

    protected $fillable = [
        'idFactura', 'idProducto', 'cantidad', 'valorUnitario',
    ];

    public $timestamps = false;
}
