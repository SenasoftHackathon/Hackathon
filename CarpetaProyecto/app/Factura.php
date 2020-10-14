<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = "facturas";

    protected $fillable = [
        'idUsuario', 'fechaCreacion', 'estado',
    ];

    public $timestamps = false;
}
