<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubLinea extends Model
{
    protected $guarded = [];

    function scopeWithAll($q) {
        $q->with('linea');
    }

    function linea() {
        return $this->belongsTo('App\Models\Linea');
    }
}
