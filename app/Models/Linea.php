<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linea extends Model
{
    protected $guarded = [];

    function scopeWithAll($q) {
        
    }

    function sub_lineas() {
        return $this->hasMany('App\Models\SubLinea');
    }
}
