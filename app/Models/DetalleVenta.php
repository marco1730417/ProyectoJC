<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    //
    protected $fillable = [
        'cantidad', 'precioUnitario',
        'proId'        
        
    ];
}