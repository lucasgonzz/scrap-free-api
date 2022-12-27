<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logistica extends Model
{
    protected $guarded = [];

    function transportista_devolucion() {
        return $this->belongsTo('App\Models\Transportista', 'transportista_devolucion_id');
    }

    function transportista_retiro() {
        return $this->belongsTo('App\Models\Transportista', 'transportista_retiro_id');
    }
}
