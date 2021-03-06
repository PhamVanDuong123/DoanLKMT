<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'order_id',
        'product_id',
        'number',
        'price',
        'price_cost',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    function order(){
        return $this->belongsTo('App\Models\Order');
    }

    function product(){
        return $this->belongsTo('App\Models\Product');
    }
}
