<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poliza extends Model
{
    protected $guarded = [];

    function scopeWithAll($query) {
        $query->with('asegurado', 'coberturas', 'tipo_producto_de_seguro', 'ramo');
    }

    function asegurado() {
        return $this->belongsTo('App\Models\Asegurado');
    }

    function coberturas() {
        return $this->belongsToMany('App\Models\Cobertura')->withPivot('deducible', 'deducible_en_pesos', 'monto_minimo', 'suma_asegurada');
    }

    function tipo_producto_de_seguro() {
        return $this->belongsTo('App\Models\TipoProductoDeSeguro');
    }

    function ramo() {
        return $this->belongsTo('App\Models\Ramo');
    }
}
