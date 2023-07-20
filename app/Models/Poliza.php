<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poliza extends Model
{
    protected $guarded = [];

    function scopeWithAll($query) {
        $query->with('coberturas');
    }

    function asegurado() {
        return $this->belongsTo('App\Models\Asegurado');
    }

    function coberturas() {
        return $this->belongsToMany('App\Models\Cobertura')->withPivot('cobertura', 'deducible');
    }

    function tipo_producto_de_seguro() {
        return $this->belongsTo('App\Models\TipoProductoDeSeguro');
    }

    function ramo() {
        return $this->belongsTo('App\Models\Ramo');
    }
}
