<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    protected $fillable = ['user_id','province','city','county','address','tel','name','is_default','created_at','updated_at'];
}
