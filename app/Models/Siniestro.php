<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Siniestro extends Model
{

    protected $guarded = [];

    protected $dates = [
        'fecha_alta_scrap_free',    
        'fecha_cierre_administrativo',  
        'fecha_cierre_aseguradora', 
        'fecha_cierre_scrap_free',  
        'fecha_denuncia',   
        'fecha_ocurrencia', 
    ];  



    function scopeWithAll($query) {
        $query->with('aseguradora', 'bienes', 'causa_siniestro', 'estado_general_siniestro', 'estado_siniestro', 'estado_siniestros', 'provincia', 'localidad', 'tipo_orden_de_servicio', 'gestor_scrap_free', 'gestor_aseguradora', 'logisticas.bienes', 'logisticas.transportista_devolucion', 'logisticas.transportista_retiro', 'centro_reparacion', 'poliza.coberturas', 'nota_importantes', 'coberturas');
    }

    function getDiasEnEstadoSiniestroAttribute() {
        if (!is_null($this->estado_siniestro)) {
            if (count($this->estado_siniestros) == 1) {
                return $this->estado_siniestros[0]->pivot->created_at->diffInDays(Carbon::now());
            } 
            return $this->estado_siniestros[count($this->estado_siniestros)-1]->pivot->created_at->diffInDays(Carbon::now());
        }
        return '-';
    }

    function coberturas() {
        return $this->belongsToMany('App\Models\Cobertura')->withPivot('cobertura', 'deducible');
    }

    function aseguradora() {
        return $this->belongsTo('App\Models\Aseguradora');
    }

    // function asegurado() {
    //     return $this->belongsTo('App\Models\Asegurado');
    // }

    function bienes() {
        return $this->hasMany('App\Models\Bien');
    }

    function nota_importantes() {
        return $this->hasMany('App\Models\NotaImportante');
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
        return $this->belongsToMany('App\Models\EstadoSiniestro')->withPivot('dias_en_estado_siniestro')->withTimestamps();
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
