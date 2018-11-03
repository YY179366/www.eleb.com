@extends('default')
@section('contents')

    <h1 style="margin:40px auto;text-align: center;color: blue">菜品各店铺月销量</h1>
    <form action="{{route('select_menu_m')}}" method="post" style="font-size: 20px;">
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
    查询月份:{{$month}};
    <br>
    <table class="table">
        <tr>
            <td>
                菜品名称
            </td>
            <td>
                店铺名称
            </td>
            <td>
                菜品供应量
            </td>
        </tr>
        @foreach($menus as $menu)
        <tr>
            <td>{{$menu->goods_name}}</td>
                <td>{{$menu->shop_name}}</td>
            <td>{{$menu->sum}}</td>
        </tr>
        @endforeach
    </table>
    <br>
    <br>
    <br>

    <a href="{{route('order_count')}}" style="float: right">返回统计页面</a>

    <br>
    <br>
    <br>


    @stop
