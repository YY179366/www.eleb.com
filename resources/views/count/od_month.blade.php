@extends('default')
@section('contents')

    <h1 style="margin:120px auto;text-align: center;color: blue">各店铺每月订单量</h1>
    <form action="{{route('select_order_m')}}" method="post" style="font-size: 20px;">
        按照月份搜索:
        选择年份: <select name="year" id="">
            @for($y=2017;$y<=date('Y');$y++)
                <option value="{{$y}}" @if(date('Y',time())==$y)selected @endif>{{$y}}</option>
            @endfor
        </select>
        选择月份: <select name="month" id="">
            @for($i=1;$i<=12;$i++)
            <option value="{{$i}}" @if(date('m',time()) == $i)selected @endif>{{$i}}月</option>
                @endfor
        </select>
        {{csrf_field()}}
        <button type="submit" class="btn btn-default">确认搜索</button>
    </form>
    <br>
    查询日期:{{$months}}
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
                <td>{{$months}}</td>
                <td>{{$shop->shop_name}}</td>
                <td>{{$shop->ct}}</td>
            </tr>
        @endforeach

    </table>

    <a href="{{route('order_count')}}" style="float: right">返回统计页面</a>

    @stop
