<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicalReport extends Model
{
    protected $guarded = [];

    function asset() {
        return $this->belongsTo('App\Models\Asset');
    }

    function probable_cause() {
        return $this->belongsTo('App\Models\ProbableCause');
    }

    function claim() {
        return $this->belongsTo('App\Models\Claim');
    }

    function technical() {
        return $this->belongsTo('App\Models\Technical');
    }
}
