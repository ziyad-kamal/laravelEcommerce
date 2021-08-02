<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table      = 'review';
    protected $fillable   = ['rate','user_id','item_id'];
    public    $timestamps = false;

    public function items()
    {
        return $this->belongsTo('App\Models\Items','item_id');
    }
}
