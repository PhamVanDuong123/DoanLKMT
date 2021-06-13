<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategoty extends Model
{
    use HasFactory;

    function user(){
        return $this->belongsTo('App\Models\User');
    }

    function posts(){
        return $this->hasMany('App\Models\Post');
    }
}
