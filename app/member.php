<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class member extends Authenticatable
{
    protected $fillable = ['username','password','updated_at','created_at','rememberToken','tel'];
}
