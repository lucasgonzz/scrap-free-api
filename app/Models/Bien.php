<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    protected $guarded = [];

    function scopeWithAll($q) {
        // $q->with('causa_bien', 'estado_bien', 'linea', 'sub_linea', 'tecnico_asegurado', 'tecnico_scrap_free', 'logistica', 'siniestro');
    } 

    function causa_bien() {
        return $this->hasOne('App\Models\CausaBien');
    }

    function estado_bien() {
        return $this->belongsTo('App\Models\EstadoBien');
    }

    function linea() {
        return $this->belongsTo('App\Models\Linea');
    }

    function sub_linea() {
        return $this->belongsTo('App\Models\SubLinea');
    }

    function tecnico_asegurado() {
        return $this->belongsTo('App\Models\Tecnico', 'tecnico_asegurado_id');
    }

    function tecnico_scrap_free() {
        return $this->belongsTo('App\Models\Tecnico', 'tecnico_scrap_free_id');
    }

    function logistica() {
        return $this->belongsTo('App\Models\Logistica');
    }

    function siniestro() {
        return $this->belongsTo('App\Models\Siniestro');
    }
}
