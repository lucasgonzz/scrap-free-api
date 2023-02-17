<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurer extends Model
{
    protected $guarded = [];

    function coverages() {
        return $this->belongsToMany('App\Models\Coverage');
    }
}
