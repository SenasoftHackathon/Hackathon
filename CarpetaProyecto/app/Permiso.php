<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $fillable = [
        'nombrePermiso', 'descripcion',
    ];

    public $timestamps = false;
}
