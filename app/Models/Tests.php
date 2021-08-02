<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tests extends Model
{
    protected $table='tests';
    protected $fillable=['price','name','photo','created_at'
                        ,'updated_at'];
}
