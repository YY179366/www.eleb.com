<?php

namespace App\Http\Controllers;

use App\Menu;
use App\ordergood;
use App\orders;
use App\Shop;
use App\member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\SignatureHelper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use App\address;
use Illuminate\Support\Facades\Validator;
use App\Cart;
class ShopController extends Controller
{
    public function index()
    {
        $datas = [];
        $shops = Shop::all();
        foreach ($shops as $shop) {
            $data = [
                "id" => $shop->id,
                "shop_name" => $shop->shop_name,
                "shop_img" => $shop->shop_img,
                "shop_rating" => $shop->shop_rating,
                "brand" => $shop->brand,
                "on_time" => $shop->on_time,
                "fengniao" => $shop->fengniao,
                "bao" => $shop->bao,
                "piao" => $shop->piao,
                "zhun" => $shop->zhun,
                "start_send" => $shop->start_send,
                "send_cost" => $shop->send_cost,
                "distance" => $shop->distance,
                "estimate_time" => $shop->estimate_time,
                "notice" => $shop->notice,
                "discount" => $shop->discount,
                "status" => $shop->status
            ];
            $datas[] = $data;
        }
        return $datas;
    }

    //获取指定商家列表\
    public function shopList(Request $request)
    {
        //dd($request);
        $id = $request->id;
        //dd($id);

        //商家店铺的信息
        $shops = DB::table('shops')->where('id', '=', $id)->first();
        //dd($shops);

        //查询商家菜品分类的数据
        $menucate = DB::table('menu_categories')->where('shop_id', '=', $id)->get();
        // dump($menucate);
        //商家菜单的信息
        $menus = DB::table('menus')->where('shop_id', '=', $id)->get();
        //dump($menus);

        //分类菜品所需的参数
        $cates = [];
        //分类下的详细菜品





        foreach ($menucate as $menuc) {
            $goods_lists = [];

            foreach ($menus as $menu) {
                //dump($menu->category_id);
                if ($menuc->id == $menu->category_id) {
                    $goods_list = [
                        "goods_id" => $menu->id,
                        "goods_name" => $menu->goods_name,
                        "rating" => $menu->rating,
                        "goods_price" => $menu->goods_price,
                        "description" => $menu->description,
                        "month_sales" => $menu->month_sales,
                        "rating_count" => $menu->rating_count,
                        "tips" => $menu->tips,
                        "satisfy_count" => $menu->satisfy_count,
                        "satisfy_rate" => $menu->satisfy_rate,
                        "goods_img" => $menu->goods_img
                    ];
                    $goods_lists[] = $goods_list;
                }
            }
            // dd($goods_lists);


            $cate = [
                "description" => $menuc->description,
                "is_selected" => $menuc->is_selected,
                "name" => $menuc->name,
                "type_accumulation" => $menuc->type_accumulation,
                //菜品分类下面的菜品详细数据
                "goods_list" => $goods_lists
            ];

            $cates[] = $cate;

        }

//dd($cates);

//exit;

        $data = [
            'id' => $shops->id,
            'shop_name' => $shops->shop_name,
            "shop_img" => $shops->shop_img,
            "shop_rating" => $shops->shop_rating,
            "brand" => $shops->brand,
            "on_time" => $shops->on_time,
            "fengniao" => $shops->fengniao,
            "bao" => $shops->bao,
            "piao" => $shops->piao,
            "zhun" => $shops->zhun,
            "start_send" => $shops->start_send,
            "send_cost" => $shops->send_cost,
            "distance" => $shops->discount,
            "estimate_time" => 30,
            "notice" => $shops->notice,
            "discount" => $shops->discount,
            //店铺评价的参数
            "evaluate" => [
                ["user_id" => 12344,
                    "username" => "w******k",
                    "user_img" => "/images/slider-pic4.jpeg",
                    "time" => "2017-2-22",
                    "evaluate_code" => 1,
                    "send_time" => 30,
                    "evaluate_details" => "不怎么好吃"]
            ],


            //菜品分类下面的菜品信息模块
            "commodity" => $cates


        ];


        return $data;

    }


    //短信验证
    public function sendSms(Request $request)
    {


        $tel = $request->tel;
        $params = [];

        // *** 需用户填写部分 ***

        // fixme 必填: 请参阅 https://ak-console.aliyun.com/ 取得您的AK信息
        $accessKeyId = "LTAIEMtdSpIMbowj";
        $accessKeySecret = "2MTyCkGGsUD7GuDkFxSPlz9JSz1wiW";

        // fixme 必填: 短信接收号码
        $params["PhoneNumbers"] = $tel;

        // fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $params["SignName"] = "qiaolei";

        // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $params["TemplateCode"] = "SMS_140695152";

        // fixme 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
        //$code=2222;
        $code = 1234;//random_int(1000, 9999);
        $params['TemplateParam'] = Array(
            "code" => $code
            //"product" => "阿里通信"
        );

        Redis::set('sms' . $tel, $code);
        Redis::expire('sms' . $tel, 300);
        // fixme 可选: 设置发送短信流水号
        $params['OutId'] = "12345";

        // fixme 可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
        $params['SmsUpExtendCode'] = "1234567";


        // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
        if (!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
            $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
        }

        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        /*$helper = new SignatureHelper();

        // 此处可能会抛出异常，注意catch
        $content = $helper->request(
            $accessKeyId,
            $accessKeySecret,
            "dysmsapi.aliyuncs.com",
            array_merge($params, array(
                "RegionId" => "cn-hangzhou",
                "Action" => "SendSms",
                "Version" => "2017-05-25",
            ))

        // fixme 选填: 启用https
        // ,true
        );*/
        return [
            "status"=> "true",
            "message"=> "获取短信验证码成功"
        ];
    }

    //验证码发送和获取
//会员注册
    public function regist(Request $request)
    {
        //Redis::connection();
        $username = $request->username;
        $tel=$request->tel;
        $password=$request->password;
        //$sms= Redis::get("tel");
        $sms=1234;

        if ($sms != $request->sms) {
            return [
                'status' => 'false',
                'message' => '注册失败'
            ];
        } else {
            Member::create([
                'username' => $username,
                'tel' => $tel,
                'password' => bcrypt($password),
            ]);
            return [
                'status' => 'true',
                'message' => '注册成功'
            ];
        }

    }
    //登录

    public function loginCheck(Request $request)
    {
        if (Auth::attempt([
            'username' => $request->name,
            'password' => $request->password,
        ])
        ) {
            return json_encode([
                'status' => 'true',
                'message' => '登录成功',
                'id' => Auth::user()->id,
                'username' => "{$request->name}",
            ]);
        } else {
            return json_encode([
                'status' => 'false',
                'message' => '登录失败',
            ]);
        }
    }
//地址列表
    public function addressList()
    {

        $id=Auth::user()->id;

        $addresses = Address::where('user_id',$id)->get();
        foreach ($addresses as &$v) {
            $v['area'] = $v['county'];
            $v['detail_address'] = $v['address'];
            $v['provence'] = $v['province'];

        }
        return json_encode($addresses);
    }
    //添加地址
    public function addAddress(Request $request)
    {
        $validator =Validator::make($request->all(), [
            'name' => 'required',
            'tel' => 'required',
            'provence' => 'required',
            'city' => 'required',
            'area' => 'required',
            'detail_address' => 'required',
        ], [
            'name.required' => '收货人姓名不能为空',
            'tel.required' => '收货人电话不能为空',
            'provence.required' => '省份不能为空',
            'city.required' => '城市不能为空',
            'area.required' => '区不能为空',
            'detail_address.required' => '详细地址不能为空',
        ]);
        if ($validator->fails()) {
            return json_encode([
                'status' => 'false',
                'message' => $validator->errors()->first(),
            ]);
        }
        if (!preg_match('/^1[3456789]\d{9}$/', $request->tel)) {
            return [
                'status' => 'false',
                'message' => '电话不正确',
            ];
        }
        $user_id = Auth::user()->id;
        address::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'tel' => $request->tel,
            'province' => $request->provence,
            'city' => $request->city,
            'county' => $request->area,
            'address' => $request->detail_address,
            'is_default' => 0,
        ]);
        return json_encode([
            'status' => 'true',
            'message' => '添加成功',
        ]);
    }
    //指定地址接口
    public function address(Request $request)
    {
        $res = Address::where('id', '=', "{$request->id}")->get();
        return json_encode([
            'id' => $res[0]->id,
            'provence' => $res[0]->province,
            'city' => $res[0]->city,
            'area' => $res[0]->county,
            'detail_address' => $res[0]->address,
            'name' => $res[0]->name,
            'tel' => $res[0]->tel,
        ]);
    }
    // 保存修改地址接口
    public function editress(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'tel' => 'required',
            'provence' => 'required',
            'city' => 'required',
            'area' => 'required',
            'detail_address' => 'required',
        ], [
            'name.required' => '收货人姓名不能为空',
            'tel.required' => '收货人电话不能为空',
            'provence.required' => '省份不能为空',
            'city.required' => '城市不能为空',
            'area.required' => '区不能为空',
            'detail_address.required' => '详细地址不能为空',
        ]);
        if ($validator->fails()) {
            return json_encode([
                'status' => 'false',
                'message' => $validator->errors()->first(),
            ]);
        }
        if (!preg_match('/^1[3456789]\d{9}$/', $request->tel)) {
            return [
                'status' => 'false',
                'message' => '电话不合法',
            ];
        }
        $address = Address::find($request->id);

        $address->update([
            'name' => $request->name,
            'tel' => $request->tel,
            'province' => $request->provence,
            'city' => $request->city,
            'county' => $request->area,
            'address' => $request->detail_address,
        ]);
        return json_encode([
            'status' => 'true',
            'message' => '修改成功',
        ]);
       // dd(1);
    }
    //获取购物车数据接口
    public function cart()
    {
        $goods_list = [];
        $f=0;
        $user_id = Auth::user()->id;
        $goods = Cart::where("user_id", '=', "{$user_id}")->get();
        foreach ($goods as $v) {
            $good = Menu::find($v->goods_id);
            $goods_list[]=
                [
                    'goods_id'=>$good->id,

                    'goods_name'=>$good->goods_name,
                    'goods_img'=>$good->goods_img,
                    'amount'=>$v->amount,
                    'goods_price'=>$good->goods_price,
                ];

            $f+=($v->amount)*$good->goods_price;
        }
        return[
            'goods_list'=>$goods_list,
            'totalCost'=>$f
        ];
    }
    //保存购物车接口
    public function addCart(Request $request)
    {
        $user_id = Auth::user()->id;
        Cart::where('user_id', '=', "{$user_id}")->delete();
        for ($i = 0; $i < count($request->goodsList); $i++) {
//            $data=[];
//            $data['goods_id']=$request->goodsList[$i];
//            $data['amount']=$request->goodsCount[$i];
//            $data['user_id']=$user_id;
            Cart::create([
                'goods_id' => $request->goodsList[$i],
                'amount' => $request->goodsCount[$i],
                'user_id' => $user_id,
            ]);
        }
        return json_encode([
            'status' => 'true',
            'message' => '添加成功',
        ]);
    }
    //添加订单接口
    public function addorder(Request $request)
    {

        $user_id=Auth::user()->id;
        $goods_id=Cart::where('user_id',$user_id)->first();
        $shop_id=Menu::where('id',$goods_id->goods_id)->first();
        //dd($shop_id->shop_id);
        $sn=date('Ymd',time()).uniqid();
        $address_id=$request->address_id;
        $address=Address::where('id',$address_id)->first();
        //dd($addre);
        $status=0;
        // $created_at=time();
        $out_trade_no=uniqid();
        $goods=Cart::where('user_id',$user_id)->get();
        //dd($goods);
        $total=0;
        $goods_ids=[];
        $amounts=[];
        foreach($goods as $v){
            $goods_id=$v->goods_id;
            $amount=$v->amount;
            $goods_price=Menu::where('id',$goods_id)->first()->goods_price;
            $total+=($amount)*($goods_price);
            $goods_ids[]=$goods_id;
            $amounts[]=$amount;
        }
        DB::beginTransaction();
        try{
            $order=orders::create([
                'user_id'=>$user_id,
                'shop_id'=>$shop_id->shop_id,
                'sn'=>$sn,
                'province'=>$address->province,
                'city'=>$address->city,
                'county'=>$address->county,
                'address'=>$address->address,
                'tel'=>$address->tel,
                'name'=>$address->name,
                'total'=>$total,
                'status'=>$status,
                //'create_at'=>$created_at,
                'out_trade_no'=>$out_trade_no,
            ]);
            $order_id=$order->id;
            foreach ($goods_ids as $k=>$goods_id){
                $goods=Menu::where('id',$goods_id)->first();
                $orderGood=ordergood::create([
                    'order_id'=>$order_id,
                    'goods_id'=>$goods_id,
                    'goods_name'=>$goods->goods_name,
                    'goods_price'=>$goods->goods_price,
                    'goods_img'=>$goods->goods_img,
                    'amount'=>$amounts[$k],
                ]);
            }

            if ($order&&$orderGood){
                DB::commit();
            }
        }catch (\Exception $e){
            DB::rollback();
        }
        return json_encode([
            "status"=> "true",
            "message"=> "添加成功",
            "order_id"=>"{$order_id}",
        ]);
    }
    //获得指定订单接口
    public function order(Request $request)
    {
        $order_id=$request->id;
        $shop_id=orders::where('id',$order_id)->first()->shop_id;

        $shops=Shop::where('id',$shop_id)->first();
        $shop_name=$shops->shop_name;
        $shop_img=$shops->shop_img;

        $orders=orders::where('id',$order_id)->first();
        $order_code=$orders->sn;
        $order_status=$orders->status;
        $order_price=$orders->total;
        $order_address=$orders->pronince.$orders->city.$orders->county.$orders->address;

        $goods=ordergood::where('order_id',$order_id)->get();
        $goods_list=[];
        foreach ($goods as $good) {

            $goods_list[]=[
                'goods_id'=>$good->goods_id,
                'goods_name'=>$good->goods_name,
                'goods_img'=>$good->goods_img,
                'goods_price'=>$good->goods_price,
                'amount'=>$good->amount,
            ];
        }
        $data=[
            "id"=>$order_id,
            "order_code"=> $order_code,
            "order_birth_time"=>date("Y-m-d H:i:s",strtotime($orders->created_at)),
            "order_status"=> "代付款",
            "shop_id"=> $shop_id,
            "shop_name"=> $shop_name,
            "shop_img"=> $shop_img,
            "goods_list"=> $goods_list,
            "order_price"=> $order_price,
            "order_address"=> $order_address
        ];
        return json_encode($data);
    }
    //修改密码
    public function changePassword(Request $request)
    {
        dd($request);
        $oldPassword=$request->oldPassword;
        $newPassword=bcrypt($request->newPassword);
        $user_id=Auth::user()->id;
        $dbPassword=Member::where('id',$user_id)->first()->password;

        if(!Hash::check($oldPassword,$dbPassword)){
            return json_encode([
                "status"=> "false",
                "message"=> "旧密码错误"
            ]);
        }
        DB::table('members')->where('id',$user_id)
            ->update(['password'=>$newPassword]);
        return json_encode([
            "status"=> "true",
            "message"=> "修改成功"
        ]);
    }
    //忘记密码接口
    public function forgetPassword(Request $request)
    {
        $tel=$request->tel;
        $sms=$request->sms;
        $password=$request->password;
        $oldsms      = Redis::get("tel");
        $vip=member::where('tel',$tel)->first();


        $validator=Validator::make($request->all(),[
            'password'=>'required',
            'tel'=>'required',
            'sms'=>'required',

        ],[
            'password.required'=>'新密码不能为空',
            'tel.required'=>'电话不能为空',
            'sms.required'=>'验证码不能为空',
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'false',
                'errors' => $validator->errors()->first()
            ];
        }elseif($sms==$oldsms&&$tel==$vip->tel){
            $vip->update([
                'password'=>bcrypt($password),
            ]);
            return json_encode([
                "status"=> "true",
                "message"=> "修改成功"
            ]);

        }else{
            return json_encode([
                "status"=> "false",
                "message"=> "修改失败"
            ]);
        }
    }
//订单列表
    public function orderList()
    { $orders = orders::where('user_id',Auth::user()->id)->get();//根据当前用户查询订单
        $lists =[];
        foreach ($orders as $order){
            $shop = Shop::where('id',$order->shop_id)->first();//商店信息
            //根据订单的id ,查询 order_goods 表里的商品信息
            $orders = [
                'id'=>$order->id,
                'order_code'=>$order->sn,
                'order_birth_time'=>date('Y-m-d H:i',strtotime($order->created_at)),
                'order_status'=>$order->status,
                'shop_id'=>$shop->id,
                'shop_name'=>$shop->shop_name,
                'shop_img'=>$shop->shop_img,
                'order_price'=>$order->total,
                'order_address'=>$order->province.$order->city.$order->county.$order->address,
            ];
            $order_goods =ordergood::where('order_id',$order->id)->get();
            foreach($order_goods as $order_good){
                $orders['goods_list']=[
                    'goods_id'=>$order_good->goods_id,
                    'goods_name'=>$order_good->goods_name,
                    'goods_img'=>$order_good->goods_img,
                    'amount'=>$order_good->amount,
                    'goods_price'=>$order_good->goods_price,
                ];
                unset($order_good['order_id']);
                unset($order_good['created_at']);
                unset($order_good['updated_at']);
                unset($order_good['id']);
                unset($order_good['order_id']);
            }
            $orders['goods_list']=$order_goods;
        }
        return json_encode([$orders]);

    }



}
