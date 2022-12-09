<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logistic extends Model
{
    protected $guarded = [];

    function transporte_devolucion() {
        return $this->belongsTo('App\Models\Transport', 'transporte_devolucion_id');
    }

    function transporte_retiro() {
        return $this->belongsTo('App\Models\Transport', 'transporte_retiro_id');
    }
}
