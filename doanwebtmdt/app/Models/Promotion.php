<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'name',
        'code',
        'start_day',
        'end_day',
        'condition',
        'qty',
        'number',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    function orders(){
        return $this->hasMany('App\Models\Order');
    }
}
