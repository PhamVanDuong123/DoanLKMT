<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;
 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname',
        'email',
        'password',
        'phone',
        'gender',
        'dob',
        'address',
        'avatar',
        'permission',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function product_categories(){
        return $this->hasMany('App\Models\ProductCategory');
    }

    function products(){
        return $this->hasMany('App\Models\Product');
    }

    function orders(){
        return $this->hasMany('App\Models\Order');
    }

    function post_categories(){
        return $this->hasMany('App\Models\PostCategory');
    }

    function posts(){
        return $this->hasMany('App\Models\Post');
    }
}
