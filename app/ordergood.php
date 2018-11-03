<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ordergood extends Model
{
    protected $fillable = ['order_id','goods_id','amount','goods_name','goods_img','goods_price','created_at','updated_at'];

    public function order()
    {
        return $this->belongsTo(orders::class,'order_id','id');
    }
}
