<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursales'; // Especificamos la tabla

    protected $fillable = ['name', 'address', 'latitude', 'longitude'];

    public $timestamps = true; // Si la tabla tiene timestamps
}



