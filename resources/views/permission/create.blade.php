@extends('default')
@section('contents')
    <div class="container">
        <h1 style="text-align: center">权限添加</h1>
        <form action="{{route('permission.store')}}" method="post">
            <label>
                权限名称:
            </label>
            <input type="text" class="form-control" placeholder="权限名称" name="name" ></br>

            {{csrf_field()}}
            <span style="float: right"><button class="btn btn-default" type="submit" >确认</button></span>
            <br><br><br>
        </form>
    </div>



@endsection
