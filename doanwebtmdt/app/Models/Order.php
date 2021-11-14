<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'code',
        'user_id',
        'name',
        'phone',
        'province_id',
        'district_id',
        'ward_id',
        'address',
        'note',
        'shipping_fee',
        'payment',
        'promotion_code',
        'total',
        'status',
        'order_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    function user(){
        return $this->belongsTo('App\Models\User');
    }

    function promotion(){
        return $this->belongsTo('App\Models\Promotion');
    }

    function products(){
        return $this->belongsToMany('App\Models\Product','order_details','order_id','product_id')->withPivot('order_id','product_id','number','price','created_at');
    }

    function order_details(){
        return $this->hasMany('App\Models\OrderDetail');
    }
}
