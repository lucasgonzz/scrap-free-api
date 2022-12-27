<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siniestro extends Model
{

    protected $guarded = [];

    function aseguradora() {
        return $this->belongsTo('App\Models\Aseguradora');
    }

    function causa_siniestro() {
        return $this->belongsTo('App\Models\CausaSiniestro');
    }

    function estado_siniestro() {
        return $this->belongsTo('App\Models\EstadoSiniestro');
    }

    function estado_siniestros() {
        return $this->belongsToMany('App\Models\EstadoSiniestro');
    }

    function provincia() {
        return $this->belongsTo('App\Models\Provincia');
    }

    function localidad() {
        return $this->belongsTo('App\Models\Localidad');
    }

    function tipo_orden_de_servicio() {
        return $this->belongsTo('App\Models\TipoOrdenDeServicio');
    }

    function gestor_scrap_free() {
        return $this->belongsTo('App\Models\GestorScrapFree');
    }

    function gestor_aseguradora() {
        return $this->belongsTo('App\Models\GestorAseguradora');
    }
}
