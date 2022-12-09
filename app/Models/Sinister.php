<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sinister extends Model
{
    protected $guarded = [];

    function insurer() {
        return $this->belongsTo('App\Models\Insurer');
    }

    function sinister_cause() {
        return $this->belongsTo('App\Models\SinisterCause');
    }

    function sinister_status() {
        return $this->belongsTo('App\Models\SinisterStatus');
    }

    function location() {
        return $this->belongsTo('App\Models\Location');
    }

    function service_order_type() {
        return $this->belongsTo('App\Models\ServiceOrderType');
    }

    function coverages() {
        return $this->belongsToMany('App\Models\Coverage');
    }
}
