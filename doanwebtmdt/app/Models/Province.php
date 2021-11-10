<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'type'
    ];

    function feeships(){
        return $this->hasMany('App\Models\Feeship');
    }

    function districts(){
        return $this->hasMany('App\Models\District');
    }
}
