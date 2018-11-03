@extends('default')
@section('contents')
    <h1 style="text-align: center">菜单管理页面</h1>
<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>菜单名称</th>
        <th>管理权限</th>
        <th>路径地址</th>
        <th>父级名称</th>
        <th>操作</th>
    </tr>
    @foreach($navs as $nav)
    <tr>
        <td>{{$nav->id}}</td>
        <td>{{$nav->name}}</td>
        <td>
            @foreach($permissions as $permission)
            @if($nav->permission_id == $permission->id){{$permission->name}}@endif
            @endforeach
        </td>
        <td>{{$nav->url}}</td>
        <td>
        {{$nav->pid?\App\Model\Nav::find($nav->pid)->name:'顶级分类'}}
        </td>
        <td>
            {{--修改--}}
            <a href="{{route('nav.edit',[$nav])}}"><button class="btn btn-primary btn-xs"><span>编辑</span></button></a>
            {{--删除--}}
            <form action="{{route('nav.destroy',[$nav])}}" method="post">
                {{method_field('DELETE')}}
                {{csrf_field()}}
                <button class="btn btn-danger btn-xs">删除</button>
            </form>
        </td>
    </tr>
        @endforeach
    {{--添加--}}
    <tr>
        <td colspan="6" style="text-align: center">
            <a href="{{route('nav.create')}}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
        </td>
    </tr>
</table>
    {{$navs->links()}}
@endsection
