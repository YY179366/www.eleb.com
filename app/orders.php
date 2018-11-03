<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $fillable = ['user_id','shop_id','sn','province','city','county','address','tel','name','total','status','created_at','out_trade_no','updated_at'];
    public function shop()
    {
        return $this->hasOne(Shop::class,'id','shop_id');
    }
}
