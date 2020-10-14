<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iva extends Model
{
    protected $table = "ivas";
    protected $fillable = [
        'porcentaje', 'fechaCreacion',
    ];

    public $timestamps = false;
}
