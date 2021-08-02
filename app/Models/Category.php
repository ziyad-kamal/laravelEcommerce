<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='category';
    protected $fillable=[
        'name','created_at','updated_at','translation_lang','translation_of','description'
    ];

    public function items(){
        return $this->hasMany('App\Models\Items','category_id');
    }

    public function categories(){
        return $this->hasMany(self::class,'translation_of');
    }

    public function scopeSelection($q){
        return $q-> select('id','name','description','translation_lang','translation_of','photo');
    }

}
