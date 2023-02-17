<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $guarded = [];

    function scopeWithAll($query) {
        $query->with('products');
    } 

    function products() {
        return $this->belongsToMany('App\Models\Product')->withPivot('amount');
    }
}
