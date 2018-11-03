@extends('default')
@section('contents')
    <h1 style="text-align: center">商家账户页面</h1>
<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>商家账号</th>
        <th>所属商家店铺</th>
        <th>所属商家店铺状态</th>
        <th>商家邮箱账号</th>
        <th>账号状态</th>
        <th>操作</th>
    </tr>
    @foreach($shop_users as $shop_user)
    <tr>
        <td>{{$shop_user->id}}</td>
        <td>{{$shop_user->name}}</td>
        <td>{{$shop_user->shop->shop_name}}</td>
        <td>{{$shop_user->shop->status?'正常':'待审核'}}</td>
        <td>{{$shop_user->email}}</td>
        <td><a href="{{route('shop_user.status',[$shop_user])}}">{{$shop_user->status?'启用':'禁用'}}</a></td>
        <td>
            {{--修改--}}
            @can('shop_user_update')
            <a href="{{route("shop_user.edit",[$shop_user])}}"><button class="btn btn-primary btn-xs"><span>编辑</span></button></a>
            @endcan
            {{--重置密码--}}
            @can('shop_user_repwd')
            <a href="{{route("shop_user.reset",[$shop_user])}}"><button class="btn btn-primary btn-xs"><span>重置密码</span></button></a>
            @endcan
            {{--删除--}}
            @can('shop_user_delete')
            <form action="{{route('shop_user.destroy',[$shop_user])}}" method="post">
                {{method_field('DELETE')}}
                {{csrf_field()}}
                <button class="btn btn-danger btn-xs">删除</button>
            </form>
                @endcan
        </td>
    </tr>
        @endforeach
    {{--添加--}}
    @can('shop_user_create')
    <tr>
        <td colspan="6" style="text-align: center">
            <a href="{{route('shop_user.create')}}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
        </td>
    </tr>
        @endcan
</table>
    {{$shop_users->links()}}
@endsection
