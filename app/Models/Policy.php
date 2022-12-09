<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    protected $guarded = [];

    function secured() {
        return $this->belongsTo('App\Models\Secured');
    }
}
