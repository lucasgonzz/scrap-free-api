<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $guarded = [];

    function scopeWithAll($q) {
        $q->with('provincia');
    }

    function provincia() {
        return $this->belongsTo(Provincia::class);
    }
}
