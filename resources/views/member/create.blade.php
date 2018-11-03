@extends('default')
@section('js_files')
    <script type="text/javascript" src="/webuploads/webuploader.js"></script>
    @stop
@section('css_files')
    <link rel="stylesheet" type="text/css" href="/webuploads/webuploader.css">
    @stop
@section('contents')
    <div class="container">
        <h1 style="text-align: center">添加管理员账号</h1>
        <form action="{{route('member.store')}}" method="post">
            <label>
                会员账号:
            </label>
            <input type="text" class="form-control" placeholder="会员账号" name="username" ></br>
            <label for="">
                会员密码:
            </label>
            <input type="password" name="password" class="form-control" placeholder="输入密码"><br>
            <br><label for="">
                会员手机号码:
            </label>
            <input type="text" name="tel" class="form-control" placeholder="输入手机号码"><br>
            <br>
            <label for="">
                会员头像上传:
            </label>
            <input type="hidden" name="coin" id="logo">
            <!--dom结构部分-->
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
            <img  id="img"/>
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
@section('js')
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
           // swf: BASE_URL + '/js/Uploader.swf',

            // 文件接收服务端。
            server: "{{route('uploads')}}",

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },

            formData:{
                _token:'{{csrf_token()}}'
            }
        });
        uploader.on('uploadSuccess',function (file,response) {
            $file = response.filename;
            $('#img').attr('src',$file);
            $('#logo').val($file);
        })
    </script>

    @endsection
