<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    function user(){
        return $this->belongsTo('App\Models\User');
    }

    function promotion(){
        return $this->belongsTo('App\Models\Promotion');
    }

    function products(){
        return $this->belongsToMany('App\Models\Product');
    }
}
