@extends('default')

@section('contents')
    <h1 style="text-align: center">修改商户账号</h1>
    <form action="{{route('shop_category.update',[$shop_user])}}" method="post" enctype="multipart/form-data">
        <label>
            商家账号名称:
        </label>
        <input type="text" class="form-control" placeholder="商家账号名称" name="name" value="{{$shop_user->name}}" readonly></br>
        <label for="">
        邮箱:
        </label>
        <input type="email" name="email" class="form-control" placeholder="邮箱" value="{{$shop_user->email}}"><br>
        <label for="">
            密码:
        </label>
        <input type="password" name="password" class="form-control" placeholder="输入密码"><span style="color: red;font-size: 12px;">如果不输入密码,代表不修改密码</span><br>
        {{csrf_field()}}
        <label for="">
        <br>
        <span style="float: right"><button class="btn btn-default" type="submit">Submit</button></span>
    </form>

@endsection

