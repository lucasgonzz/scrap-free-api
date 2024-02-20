<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    protected $guarded = [];

    protected $dates = [
        'fecha_compra',
    ];

    function scopeWithAll($q) {
        $q->with('images', 'foto_estudio_mercado');
        // $q->with('causa_bien', 'estado_bien', 'linea', 'sub_linea', 'tecnico_asegurado', 'tecnico_scrap_free', 'logistica', 'siniestro');
    } 

    function coberturas_aplicadas() {
        return $this->belongsToMany(Cobertura::class, 'bien_cobertura_aplicada', 'bien_id', 'cobertura_id')->withPivot('remanente_a_cubrir_reparacion', 'remanente_a_cubrir_a_nuevo', 'deducible', 'deducible_aplicado', 'fondos_reparacion', 'fondos_a_nuevo', 'deducible_aplicado');
    }

    function images() {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    function foto_estudio_mercado() {
        return $this->hasMany(FotoEstudioMercado::class);
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

    function coberturas() {
        return $this->belongsToMany('App\Models\Cobertura')->withPivot('suma_asegurada', 'deducible');
    }
}
