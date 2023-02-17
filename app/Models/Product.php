<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    function scopeWithAll($query) {
        $query->with('images');
    }

    function images() {
        return $this->morphMany('App\Models\Image', 'imageable');
    }
}
