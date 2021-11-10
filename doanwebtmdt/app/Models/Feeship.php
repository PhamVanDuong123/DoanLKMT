<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'province_id',
        'district_id',
        'ward_id',
        'fee'
    ];

    function province(){
        return $this->belongsTo('App\Models\Province');
    }

    function district(){
        return $this->belongsTo('App\Models\District');
    }

    function ward(){
        return $this->belongsTo('App\Models\Ward');
    }
}
