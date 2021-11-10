<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'type',
        'province_id'
    ];

    function feeships(){
        return $this->hasMany('App\Models\Feeship');
    }

    function province(){
        return $this->belongsTo('App\Models\Province');
    }

    function wards(){
        return $this->hasMany('App\Models\Ward');
    }
}
