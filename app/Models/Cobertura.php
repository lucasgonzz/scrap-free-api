<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cobertura extends Model
{
    protected $guarded = [];

    function scopeWithAll($q) {
        
    } 

    function aseguradoras() {
        return $this->belongsToMany('App\Models\Aseguradora');
    }
}
