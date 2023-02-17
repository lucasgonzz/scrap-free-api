<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CausaProbable extends Model
{
    protected $guarded = [];

    function bien() {
        return $this->belongsTo('App\Models\Bien');
    }

    function causa_probable() {
        return $this->belongsTo('App\Models\CausaProbable');
    }

    function siniestro() {
        return $this->belongsTo('App\Models\Siniestro');
    }

    function tecnico() {
        return $this->belongsTo('App\Models\Tecnico');
    }
}
