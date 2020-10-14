<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = "proveedores";
    protected $fillable = [
        'nombre', 'direccion', 'correo', 'estado',
    ];

    public $timestamps = false;
}
