<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "productos";

    protected $fillable = [
        'idProveedor', 'idIva', 'nombre', 'precio', 'stockBodega', 'estado',
    ];

    public $timestamps = false;
}
