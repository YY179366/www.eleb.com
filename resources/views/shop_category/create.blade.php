@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <h1>添加文章类型</h1>
    <form action="{{route('shop_category.store')}}" method="post" enctype="multipart/form-data">
        <label>
            新增分类名称:
        </label>
        <input type="text" class="form-control" placeholder="分类名称" name="name" ></br>
        <label for="">
            店铺图片
        </label>
        <input type="hidden" name="logo" id="logo">
        <!--dom结构部分-->
        <div id="uploader-demo">
            <!--用来存放item-->
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker">选择图片</div>
        </div>
        <img  id="img"/>
        <br>
        {{csrf_field()}}
        <label for="">
        分类状态:
        </label>
        <label>
        显示:<input type="radio" name="status" value="1">
        </label>

        <label>
        隐藏:
            <input type="radio" name="status" value="0">
        </label>
        <br>
        <label for="">
            验证码:
        </label>
        <input id="captcha" class="form-control" name="captcha" >
        <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">


        <span style="float: right"><button class="btn btn-default" type="submit">Submit</button></span>
    </form>
@endsection
