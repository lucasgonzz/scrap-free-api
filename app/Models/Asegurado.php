<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asegurado extends Model
{
    protected $guarded = [];

    function scopeWithAll($q) {
        $q->with('aseguradoras', 'polizas');        
    } 

    function aseguradoras() {
        return $this->belongsToMany('App\Models\Aseguradora');
    }

    function polizas() {
        return $this->hasMany('App\Models\Poliza');
    }
}
