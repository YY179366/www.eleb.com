@extends('default')
@section('contents')
    <div class="container">
        <h1 style="text-align: center">权限修改</h1>
        <form action="{{route('permission.update',[$permission])}}" method="post">
            <label>
                权限名称:
            </label>
            <input type="text" class="form-control" placeholder="权限名称" name="name" value="{{$permission->name}}"></br>

            {{csrf_field()}}
            {{method_field('PATCH')}}
            <span style="float: right"><button class="btn btn-default" type="submit" >确认</button></span>
            <br><br><br>
        </form>
    </div>



@endsection
