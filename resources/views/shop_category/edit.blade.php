@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <h1 style="text-align: center">修改文章类型</h1>
    <form action="{{route('shop_category.update',[$shop_category])}}" method="post" enctype="multipart/form-data">
        <label>
            修改分类名称:
        </label>
        <input type="text" class="form-control" placeholder="分类名称" name="name" value="{{$shop_category->name}}"></br>
        <label for="">
            店铺图片
        </label>
        <input type="hidden" name="logo" id="logo">
        <input type="hidden" name="old_logo" value="{{$shop->shop_img}}">
        <!--dom结构部分-->
        <div id="uploader-demo">
            <!--用来存放item-->
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker">选择图片</div>
        </div>
        <img src="{{$shop->shop_img}}" alt="" style="width: 40px;" id="img">
        <br>
        <br>
        {{csrf_field()}}
        {{method_field('PATCH')}}
        <label for="">
        分类状态:
        </label>
        <label>
        显示:<input type="radio" name="status" value="1" @if($shop_category->status == 1)checked @endif>
        </label>

        <label>
        隐藏:<input type="radio" name="status" value="0" @if($shop_category->status == 0)checked @endif>
        </label>

        <span style="float: right"><button class="btn btn-default" type="submit">Submit</button></span>
    </form>

@endsection
