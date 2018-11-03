@extends('default')
@section('contents')
    <div style="text-align: center;margin-top: 40px;">
        <a href="{{route('od_day')}}">订单---按具体日期统计</a><br><br>
        <a href="{{route('od_month')}}">订单---按月份统计</a><br><br>
        <a href="{{route('me_day')}}">菜品---按具体日期统计</a><br><br>
        <a href="{{route('me_month')}}">菜品---按月份统计</a><br>
    </div>
    <div class="row" style="margin-top: 80px;">
        <div class="col-md-6">
            <table class="table table-striped">
                <tr>
                    <td colspan="4"><h1 style="text-align: center;color: blue">商家订单量统计</h1></td>
                </tr>
                <tr>
                    <td>店铺名称</td>
                    <td>店铺当天订单数</td>
                    <td>店铺当月订单数</td>
                    <td>店铺当年总订单数</td>
                </tr>

                <tr>
                    @for($i=0;$i<count($keys);$i++)
                    <td>{{$keys[$i]}}</td>
                    <td>{{$order_all[$keys[$i]]}}</td>
                    <td>{{$order_month[$keys[$i]]}}</td>
                    <td>{{$order_day[$keys[$i]]}}</td>
                </tr>
                @endfor
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-striped">
                <tr>
                    <td colspan="5" style="color: #dc2933"><h1 style="text-align: center">商家菜品销量统计</h1></td>
                </tr>
                <tr>
                    <td>菜品名称</td>
                    <td>店铺名称</td>
                    <td>菜品当天下单数量</td>
                    <td>菜品当月下单数量</td>
                    <td>菜品当年下单数量</td>
                </tr>
                @foreach($menus as $menu)
                    <tr>
                        <td>{{$menu->goods_name}}</td>
                        @foreach($menu['shops'] as $me)
                            <td>{{$me->shop_name}}</td>
                        @endforeach
                        <td>{{$menu->count_day}}</td>
                        <td>{{$menu->count_mouth}}</td>
                        <td>{{$menu->count_all}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop