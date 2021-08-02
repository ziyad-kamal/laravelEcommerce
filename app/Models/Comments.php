<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table='comment';
    protected $fillable=['comment','user_id','item_id','created_at','updated_at','notification'];

    public function users(){
        return $this->belongsTo('App\User','user_id');
    }

    public function items(){
        return $this->belongsTo('App\Models\Items','item_id');
    }

}
