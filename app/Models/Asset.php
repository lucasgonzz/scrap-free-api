<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $guarded = [];

    function asset_claim_cause() {
        return $this->hasOne('App\AssetClaimCause');
    }

    function asset_status() {
        return $this->belongsTo('App\AssetStatus');
    }

    function line() {
        return $this->belongsTo('App\Line');
    }

    function sub_line() {
        return $this->belongsTo('App\SubLine');
    }

    function technical_secured() {
        return $this->belongsTo('App\Technical', 'technical_secured_id');
    }

    function technical_scrap_free() {
        return $this->belongsTo('App\Technical', 'technical_scrap_free_id');
    }
}
