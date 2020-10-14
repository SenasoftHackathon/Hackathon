<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Existencia extends Model
{
    protected $table = "existencias";

    protected $fillable = [
        'idSucursal', 'idProducto', 'stockBodega', 'stockSucursal',
    ];

    public $timestamps = false;
}
