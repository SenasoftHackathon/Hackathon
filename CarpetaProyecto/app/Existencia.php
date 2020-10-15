<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Existencia extends Model
{
    protected $table = "existencias";

    protected $fillable = [
        'idSucursal', 'idProducto', 'stockSucursal',
    ];

    public $timestamps = false;
}
