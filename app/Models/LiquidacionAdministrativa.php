<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiquidacionAdministrativa extends Model
{
    protected $guarded = [];

    function scopeWithAll($q) {
        
    }

    function coberturas() {
        return $this->belongsToMany(Cobertura::class)->withPivot('suma_asegurada', 'perdidas', 'deducible', 'indemnizacion');
    }

    function bienes() {
        return $this->belongsToMany(Bien::class)->withPivot('anos_antiguedad', 'procentage_depreciacion', 'valor_depreciado', 'indemnizacion', 'ratio', 'deducible_aplicado', 'reparacion_con_deducible', 'deducible_aplicado_a_reparacion')->orderBy('created_at', 'ASC');
    }
}
