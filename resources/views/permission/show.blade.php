@extends('default')
@section('contents')
    <div style="text-align: center;margin-top: 120px;">
        <h1 style="color: red">权限名称:{{$permission->name}}</h1>
        {{$permission->guard_name}}<br>
        创建日期:{{$permission->created_at}}
    </div>
    <span style="float: right">
        <a href="{{route('permission.index')}}">返回权限管理</a>
    </span>
@endsection
