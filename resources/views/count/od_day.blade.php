@extends('default')
@section('contents')

    <h1 style="margin:120px auto;text-align: center;color: blue">各店铺每日订单量</h1>
    <form action="{{route('select_order_d')}}" method="post">
        按照日期搜索:<input type="date" name="time">
        {{csrf_field()}}
        <button type="submit" class="btn btn-default">确认搜索</button>
    </form>
    <br>
    查询日期:{{$time}}
    <br>
    <table class="table">
        <tr>
            <td>
                查询时间
            </td>
            <td>
                店铺名称
            </td>
            <td>
                订单量
            </td>
        </tr>
        @foreach($shops as $shop)
        <tr>
            <td>{{$time}}</td>
            <td>{{$shop->shop_name}}</td>
            <td>{{$shop->ct}}</td>
        </tr>
        @endforeach
    </table>


    <a href="{{route('order_count')}}" style="float: right">返回统计页面</a>
    @stop
