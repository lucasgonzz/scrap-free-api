<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poliza extends Model
{
    protected $guarded = [];

    function asegurado() {
        return $this->belongsTo('App\Models\Asegurado');
    }

    function coberturas() {
        return $this->belongsToMany('App\Models\Cobertura');
    }

    function ramo() {
        return $this->belongsTo('App\Models\Ramo');
    }
}
