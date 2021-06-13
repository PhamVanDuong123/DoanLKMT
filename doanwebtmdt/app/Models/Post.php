<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    function post_category(){
        return $this->belongsTo('App\Models\PostCategory');
    }

    function user(){
        return $this->belongsTo('App\Models\User');
    }
}
