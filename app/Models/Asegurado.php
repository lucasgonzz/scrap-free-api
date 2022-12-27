<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asegurado extends Model
{
    protected $guarded = [];

    function aseguradoras() {
        return $this->belongsToMany('App\Models\Aseguuradora');
    }
}
