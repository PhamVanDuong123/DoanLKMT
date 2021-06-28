<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable  = [
        'name',
        'phone',
        'email',
        'address',
        'country',
        'logo',
        'website',
        'stautus',
        'created_at',
        'updated_at',
        


    ];
    
   
    function products(){
        return $this->hasMany('App\Models\Product');
    }
}
