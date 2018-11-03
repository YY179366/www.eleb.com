@extends('default')
@section('contents')
    <h1 style="text-align: center">角色管理</h1>
    <table class="table table-striped">
        <tr>
            <td>编号</td>
            <td>角色名称</td>
            <td>权限</td>
            <td>操作</td>
        </tr>
        @foreach($roles as $role)
        <tr>
            <td>{{$role->id}}</td>
            <td>{{$role->name}}</td>
            <td>
            @foreach($role->permissions as $value)
                    {{$value->name}},
            @endforeach
            </td>
            <td>
                @can('admin_update')
                <a href="{{route('role.edit',[$role])}}"><button class="btn btn-primary btn-xs"><span>编辑</span></button></a>
                @endcan
                {{--删除--}}
                    @can('admin_delete')
                <form action="{{route('role.destroy',[$role])}}" method="post">
                    {{method_field('DELETE')}}
                    {{csrf_field()}}
                    <button class="btn btn-danger btn-xs">删除</button>
                </form>
                        @endcan
            </td>
        </tr>
        @endforeach
        @can('admin_create')
        <tr>
                <td colspan="3" style="text-align: center">
                    <a href="{{route('role.create')}}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                </td>
        </tr>
        @endcan
    </table>


    @stop
