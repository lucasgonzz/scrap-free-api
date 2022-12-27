<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aseguradora extends Model
{
    protected $guarded = [];

    function asegurados() {
        return $this->belongsToMany('App\Models\Aseguurado');
    }

    function coberturas() {
        return $this->belongsToMany('App\Models\Cobertura');
    }
}
