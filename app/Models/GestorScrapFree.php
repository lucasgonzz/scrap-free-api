<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GestorScrapFree extends Model
{
    protected $guarded = [];

    function scopeWithAll($q) {
        $q->with('unidad_negocio');
    } 

    function unidad_negocio() {
        return $this->belongsTo(UnidadNegocio::class);
    }
}
