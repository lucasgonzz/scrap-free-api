<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HonorarioLiquidacion extends Model
{
    protected $guarded = [];

    function scopeWithAll($q) {
        $q->with('aseguradora');
    } 

    function aseguradora() {
        return $this->belongsTo(Aseguradora::class);
    }
}
