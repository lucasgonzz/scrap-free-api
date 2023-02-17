<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $guarded = [];

    protected $dates = [ 'fecha_ocurrencia', 'fecha_denuncia', 'fecha_alta_scrap_free', 'fecha_cierre_scrap_free', 'fecha_alta_retiro', 'fecha_agenda_retiro', 'fecha_agenda_entrega', 'fecha_retiro', 'fecha_recibido', 'fecha_estimada_devolucion', 'fecha_combra_fabricacion', 'fecha_reporte', 'fecha_cierre_administrativo', 'fecha_confirmacion_sancor', 'fecha_reparacion', 'fecha_alta_transporte_devolucion', 'fecha_retiro_para_devolucion', 'fecha_devolucion',
    ];

    function aseguradora() {
        return $this->belongsTo('App\Model\Insurer');
    }

    function producto() {
        return $this->belongsTo('App\Model\Product');
    }

    function causa() {
        return $this->belongsTo('App\Model\Cause');
    }

    function gestor_scrap_free() {
        return $this->belongsTo('App\Model\ScrapFreeManager');
    }

    function gestor_aseguradora() {
        return $this->belongsTo('App\Model\InsurerManager');
    }

    function tipo_orden_servicio() {
        return $this->belongsTo('App\Model\ServiceOrderType');
    }

    function resolucion() {
        return $this->belongsTo('App\Model\Resolution');
    }

    function estados() {
        return $this->belongsToMany('App\Model\Status');
    }

    function linea() {
        return $this->belongsTo('App\Model\Line');
    }

    function centro_reparacion() {
        return $this->belongsTo('App\Model\RepairCenter');
    }

    function transporte_retiro() {
        return $this->belongsTo('App\Model\Transport', 'transporte_retiro_id');
    }

    function localidad() {
        return $this->belongsTo('App\Model\Location');
    }

    function transporte_devolucion() {
        return $this->belongsTo('App\Model\Transport', 'transporte_devolucion_id');
    }

    function technical() {
        return $this->belongsTo('App\Model\Technical');
    }

}
