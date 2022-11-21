<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $guarded = [];

    function businnes_unit() {
        return $this->belongsTo('App\BussinesUnit');
    }
}
