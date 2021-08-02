<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admins extends Authenticatable
{
    protected $table='admins';
    protected $fillable = [
        'name', 'email', 'password','updated_at','created_at'
    ];

    
}
