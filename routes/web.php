<?php
//商家列表
Route::get('shop/index','ShopController@index');
//指定商家接口
Route::get('shop/list','ShopController@shopList');
//获取短信验证码;
Route::get('/sendSms','ShopController@sendSms');//验证码
Route::any('/regist','ShopController@regist');//注册
Route::post('/loginCheck', 'ShopController@loginCheck');//登录验证
Route::get('/addressList', 'ShopController@addressList');//地址列表
Route::post('/addAddress', 'ShopController@addAddress');//保存新增地址
Route::get('/address', 'ShopController@address');//指定地址
Route::post('/editress', 'ShopController@editress');//保存修改地址

Route::post('/addCart', 'ShopController@addCart');//保存购物车
Route::get('/cart', 'ShopController@cart');//获取购物车数据
Route::any('/addorder', 'ShopController@addorder');//保存购物车
Route::get('/order', 'ShopController@order');//获取指定订单
Route::post('/changePassword','ShopController@changePassword');//修改密码
Route::post('/forgetPassword','ShopController@forgetPassword');//忘记密码
Route::get('/orderList','ShopController@orderList');//订单列表

//Route::prefix('www.eleb.com')->group(function (){
    //Route::post('','CartController@addCart');
  //  Route::get('cartView','CartController@cartView');
//});
