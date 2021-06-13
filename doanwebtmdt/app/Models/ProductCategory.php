<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table="product_categories";

    function user(){
        return $this->belongsTo('App\Models\User');
    }

    function products(){
        return $this->hasMany('App\Models\Product');
    }

    function productImages(){
        return $this->hasMany('App\Models\ProductImage');
    }
}
