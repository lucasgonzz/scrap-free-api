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
        return $this->belongsToMany(Bien::class)->withPivot('anos_antiguedad', 'procentage_depreciacion', 'valor_depreciado', 'indemnizacion_reparacion', 'indemnizacion_a_nuevo', 'ratio', 'deducible_aplicado_a_reparacion', 'deducible_aplicado_a_nuevo');
    }
}
