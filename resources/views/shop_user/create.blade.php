@extends('default')
@section('js_files')
    <script type="text/javascript" src="/webuploads/webuploader.js"></script>
@stop
@section('css_files')
    <link rel="stylesheet" type="text/css" href="/webuploads/webuploader.css">
@stop
@section('contents')
    <div class="container">
        <h1 style="text-align: center">添加商户账号</h1>
        <form action="{{route('shop.store')}}" method="post" enctype="multipart/form-data">
            <label>
                商家账号名称:
            </label>
            <input type="text" class="form-control" placeholder="商家账号名称" name="name" ></br>
            <label for="">
                邮箱:
            </label>
            <input type="email" name="email" class="form-control" placeholder="邮箱"><br>
            <label for="">
                密码:
            </label>
            <input type="password" name="password" class="form-control" placeholder="输入注册密码"><br>
            <br>

        <hr>
        <h1 style="text-align: center">添加店铺信息</h1>
            <label>
                新增店铺分类类型:
            </label>
            <select name="shop_category_id" id="">
                @foreach($shop_categories as $shop_category)
                    <option value="{{$shop_category->id}}">{{$shop_category->name}}</option>
                @endforeach
            </select></br>

            <label for="">
                店铺名称
            </label>
            <input type="text" name="shop_name" class="form-control" placeholder="分类名称"></br>

            <label for="">
                起送金额
            </label>
            <input type="text" name="start_send" class="form-control" placeholder="起送金额"></br>

            <label for="">
                配送费
            </label>
            <input type="text" name="send_cost" class="form-control" placeholder="配送费"></br>

            <label for="">
                店公告
            </label>
            <input type="text" name="notice" class="form-control" placeholder="店公告"></br>

            <label for="">
                优惠信息
            </label>
            <input type="text" name="discount" class="form-control" placeholder="优惠信息"></br>

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

            <label for="">
                评分
            </label>
            <input type="text" name="shop_rating" value="0" readonly class="form-control"><br>

            <label for="">
                是否是品牌&emsp;&emsp;&emsp;
            </label>
            <label>
                是:<input type="radio" name="brand" value="1">
            </label>
            &emsp;&emsp;&emsp;
            <label>
                否:<input type="radio" name="brand" value="0">
            </label></br>

            <label for="">
                是否准时送达&emsp;&emsp;
            </label>
            <label>
                是:<input type="radio" name="on_time" value="1">
            </label>
            &emsp;&emsp;&emsp;
            <label>
                否:<input type="radio" name="on_time" value="0">
            </label></br>

            <label for="">
                是否蜂鸟配送&emsp;&emsp;
            </label>
            <label>
                是:<input type="radio" name="fengniao" value="1">
            </label>
            &emsp;&emsp;&emsp;
            <label>
                否:<input type="radio" name="fengniao" value="0">
            </label></br>

            <label for="">
                是否保标记&emsp;&emsp;&emsp;
            </label>
            <label>
                是:<input type="radio" name="bao" value="1">
            </label>
            &emsp;&emsp;&emsp;
            <label>
                否:<input type="radio" name="bao" value="0">
            </label></br>

            <label for="">
                是否票标记&emsp;&emsp;&emsp;
            </label>
            <label>
                是:<input type="radio" name="piao" value="1">
            </label>
            &emsp;&emsp;&emsp;
            <label>
                否:<input type="radio" name="piao" value="0">
            </label></br>

            <label for="">
                是否准标记&emsp;&emsp;&emsp;
            </label>
            <label>
                是:<input type="radio" name="zhun" value="1">
            </label>
            &emsp;&emsp;&emsp;
            <label>
                否:<input type="radio" name="zhun" value="0">
            </label></br>

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
