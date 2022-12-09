<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessUnit extends Model
{
    protected $guarded = [];

    function insurer() {
        return $this->belongsTo('App\Model\Insurer');
    }
}
