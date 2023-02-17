<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logistica extends Model
{
    protected $guarded = [];

    function scopeWithAll($q) {
        $q->with('bienes', 'transportista_devolucion', 'transportista_retiro');
    }

    function bienes() {
        return $this->hasMany('App\Models\Bien');
    }

    function transportista_devolucion() {
        return $this->belongsTo('App\Models\Transportista', 'transportista_devolucion_id');
    }

    function transportista_retiro() {
        return $this->belongsTo('App\Models\Transportista', 'transportista_retiro_id');
    }
}
