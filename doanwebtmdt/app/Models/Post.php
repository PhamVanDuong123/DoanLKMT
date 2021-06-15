<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'name',
        'code',
        'short_desc',
        'content',
        'post_category_id',
        'user_id',
        'thumb',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    function post_category(){
        return $this->belongsTo('App\Models\PostCategory');
    }

    function user(){
        return $this->belongsTo('App\Models\User');
    }
}
