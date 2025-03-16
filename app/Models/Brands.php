<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $table='brands';
    protected $fillable=[
        'name'
    ];

    public function items(){
        return $this->hasMany('App\Models\Items','brand_id');
    }
}
