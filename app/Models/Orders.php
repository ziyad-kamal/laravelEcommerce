<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table='orders';
    protected $fillable=['total_amount','user_id','item_id','created_at'
                        ,'updated_at','bank_transaction_id','rating'];
    public $timestamps=true;

    public function users(){
        return $this->belongsTo('App\User','user_id');
    }

    public function items(){
        return $this->belongsTo('App\Models\Items','item_id');
    }

    public function scopeSelection($q)
    {
        return $q->select('total_amount','user_id','item_id','created_at','id','rating');
    }
}
