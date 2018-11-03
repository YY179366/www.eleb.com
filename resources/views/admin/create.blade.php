@extends('default')
@section('contents')
    <div class="container">
        <h1 style="text-align: center">添加管理员账号</h1>
        <form action="{{route('admin.store')}}" method="post">
            <label>
                管理员账号:
            </label>
            <input type="text" class="form-control" placeholder="管理员账号" name="name" ></br>
            <label for="">
                管理员邮箱:
            </label>
            <input type="email" name="email" class="form-control" placeholder="邮箱"><br>
            <label for="">
                管理员密码:
            </label>
            <input type="password" name="password" class="form-control" placeholder="输入添加密码"><br>
            <label for="">
                管理员权限:
            </label>
            <div class="checkbox">
                @foreach($roles as $role)
                &emsp;&emsp;<input type="checkbox" name="roles[]" value="{{$role->id}}" >{{$role->name}}&emsp;&emsp;
                @endforeach
            </div>
            <br>
            <br>
            <label for="">
                验证码:
            </label>
            <input id="captcha" class="form-control" name="captcha" >
            <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">

            <input type="hidden" name="status" value="0"><br><br><br>

            {{csrf_field()}}
            <span style="float: right"><button class="btn btn-default" type="submit">确认</button></span>
            <br><br><br>
        </form>
    </div>



@endsection
