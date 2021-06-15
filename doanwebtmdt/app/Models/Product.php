<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'id',
        'name',
        'code',
        'brand_id',
        'price',
        'old_price',
        'thumb',
        'inventory_num',
        'short_desc',
        'detail_desc',
        'warranty',
        'product_category_id',
        'account_id',
        'status',
        'created_at',
        'updated_at'
    ];

    function user(){
        return $this->belongsTo('App\Models\User');
    }

    function brand(){
        return $this->belongsTo('App\Models\Brand');
    }

    function product_category(){
        return $this->belongsTo('App\Models\ProductCategory');
    }

    function orders(){
        return $this->belongsToMany('App\Models\Order');
    }
}
