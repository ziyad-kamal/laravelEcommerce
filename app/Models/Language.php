<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table='language';
    protected $fillable=[
        'name','abbr','locale','direction','active'
    ];

    public $timestamps=false;

    public function scopeSelection($q){
        return $q->select('name','direction','id','abbr','active');
    }
}
