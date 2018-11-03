@extends('default')
@section('contents')
    <h1 style="text-align: center">权限管理</h1>
    <table class="table table-striped">
        <tr>
            <td></td>
            <td>编号</td>
            <td>权限名称</td>
            <td>操作</td>
        </tr>
        @foreach($permissions as $permission)
        <tr>
            <td></td>
            <td>{{$permission->id}}</td>
            <td>{{$permission->name}}</td>
            <td>
                @can('admin_update')
                <a href="{{route('permission.edit',[$permission])}}"><button class="btn btn-primary btn-xs"><span>编辑</span></button></a><br>
                @endcan
                @can('admin_update')
                <a href="{{route('permission.show',[$permission])}}"><button class="btn btn-warning btn-xs"><span>查看</span></button></a>
                    @endcan
                {{--删除--}}
                    @can('admin_delete')
                <form action="{{route('permission.destroy',[$permission])}}" method="post">
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
                <td colspan="4" style="text-align: center">
                    <a href="{{route('permission.create')}}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                </td>
        </tr>
            @endcan

    </table>
<div style="float: right">
    {{$permissions->links()}}
</div>

    @stop
