@extends('default')
@section('contents')
    <h1 style="text-align: center">平台用户页面</h1>
<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>管理员账号</th>
        <th>管理员邮箱</th>
        <th>注册日期</th>
        <th>修改日期</th>
        <th>操作</th>
    </tr>
    @foreach($admins as $admin)
    <tr>
        <td>{{$admin->id}}</td>
        <td>{{$admin->name}}</td>
        <td>{{$admin->email}}</td>
        <td>{{$admin->created_at}}</td>
        <td>{{$admin->updated_at}}</td>
        <td>
            {{--修改--}}
            @can('admin_create' )
            <a href="{{route("admin.edit",[$admin])}}"><button class="btn btn-primary btn-xs"><span>编辑</span></button></a>
            @endcan
            {{--删除--}}
            @can('admin_delete')
            <form action="{{route('admin.destroy',[$admin])}}" method="post">
                {{method_field('DELETE')}}
                {{csrf_field()}}
                <button class="btn btn-danger btn-xs">删除</button>
            </form>
                @endcan
        </td>
    </tr>
        @endforeach
    {{--添加--}}
    @can('admin_create')
    <tr>
        <td colspan="6" style="text-align: center">
            <a href="{{route('admin.create')}}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
        </td>
    </tr>
        @endcan
</table>
    {{$admins->links()}}
@endsection
