<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siniestro extends Model
{

    protected $guarded = [];

    function scopeWithAll($query) {
        $query->with('aseguradora', 'asegurado.polizas.coberturas', 'asegurado.aseguradoras', 'bienes', 'causa_siniestro', 'estado_general_siniestro', 'estado_siniestro', 'estado_siniestros', 'provincia', 'localidad', 'tipo_orden_de_servicio', 'gestor_scrap_free', 'gestor_aseguradora', 'logisticas.bienes', 'logisticas.transportista_devolucion', 'logisticas.transportista_retiro', 'centro_reparacion', 'poliza.coberturas');
    }

    function aseguradora() {
        return $this->belongsTo('App\Models\Aseguradora');
    }

    function asegurado() {
        return $this->belongsTo('App\Models\Asegurado');
    }

    function bienes() {
        return $this->hasMany('App\Models\Bien');
    }

    function causa_siniestro() {
        return $this->belongsTo('App\Models\CausaSiniestro');
    }

    function estado_general_siniestro() {
        return $this->belongsTo('App\Models\EstadoGeneralSiniestro');
    }

    function estado_siniestro() {
        return $this->belongsTo('App\Models\EstadoSiniestro');
    }

    function estado_siniestros() {
        return $this->belongsToMany('App\Models\EstadoSiniestro')->withTimestamps();
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

    function logisticas() {
        return $this->hasMany('App\Models\Logistica');
    }

    function centro_reparacion() {
        return $this->belongsTo('App\Models\CentroReparacion');
    }

    function poliza() {
        return $this->belongsTo('App\Models\Poliza');
    }
}
