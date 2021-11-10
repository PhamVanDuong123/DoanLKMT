<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'type',
        'district_id'
    ];

    function feeships(){
        return $this->hasMany('App\Models\Feeship');
    }

    function district(){
        return $this->belongsTo('App\Models\District');
    }
}
