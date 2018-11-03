@extends('default')
@section('contents')
    <h1 style="text-align: center">商家信息页面</h1>
<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>店铺类型</th>
        <th>店铺名称</th>
        <th>店铺图片</th>
        <th>店铺评分</th>
        <th>是否是品牌</th>
        <th>是否准时送达</th>
        <th>是否蜂鸟配送</th>
        <th>是否保标记</th>
        <th>是否票标记</th>
        <th>是否准标记</th>
        <th>起送金额</th>
        <th>配送费</th>
        <th>店公告</th>
        <th>优惠信息</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    @foreach($shops as $shop)
    <tr>
        <td>{{$shop->id}}</td>
        <td>{{$shop->shop_category->name}}</td>
        <td>{{$shop->shop_name}}</td>
        <td><img src="{{$shop->shop_img}}" alt="" style="width: 40px;"></td>
        <td>{{$shop->shop_rating}}</td>
        <td>{{$shop->brand}}</td>
        <td>{{$shop->on_time?'是':'否'}}</td>
        <td>{{$shop->fengniao?'是':'否'}}</td>
        <td>{{$shop->bao?'是':'否'}}</td>
        <td>{{$shop->piao?'是':'否'}}</td>
        <td>{{$shop->zhun?'是':'否'}}</td>
        <td>{{$shop->start_send}}</td>
        <td>{{$shop->send_cost}}</td>
        <td>{{$shop->notice}}</td>
        <td>{{$shop->discount}}</td>
        <td>{{$shop->status?'正常':'待审核'}}</td>
        <td>
            @can('shop_create')
            {{--修改--}}
            <a href="{{route("shop.edit",[$shop])}}"><button class="btn btn-primary btn-xs"><span>编辑</span></button></a>
            @endcan
            {{--删除--}}
                @can('shop_delete')
            <form action="{{route('shop.destroy',[$shop])}}" method="post">
                {{method_field('DELETE')}}
                {{csrf_field()}}
                <button class="btn btn-danger btn-xs">删除</button>
            </form>
                @endcan
            {{--审核状态--}}
                @can('shop_status')
            <a href="{{route('shop.show',[$shop])}}"><button class="btn btn-warning btn-xs"><span>商家审核</span></button></a>
                    @endcan
        </td>
    </tr>
        @endforeach
    {{--添加--}}
    @can('shop_create')
    <tr>
        <td colspan="17" style="text-align: center">
            <a href="{{route('shop.create')}}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
        </td>
    </tr>
        @endcan
</table>
    {{$shops->links()}}
@endsection
