<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'description',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    function user(){
        return $this->belongsTo('App\Models\User');
    }

    function posts(){
        return $this->hasMany('App\Models\Post');
    }
}
