@extends('default')
@section('contents')

    <h1 style="margin:40px auto;text-align: center;color: blue">菜品各店铺每天销量</h1>
    <form action="{{route('select_menu_d')}}" method="post">
        按照日期搜索:<input type="date" name="time">
        {{csrf_field()}}
        <button type="submit" class="btn btn-default">确认搜索</button>
    </form>
    <br>
    <h4>时间:</h4>
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
