@extends('default')
@section('contents')
    <div class="container">
        <h1 style="text-align: center">修改活动信息</h1>
        <form action="{{route('activity.update',[$activity])}}" method="post">
            <label>
                活动名称:
            </label>
            <input type="text" class="form-control" placeholder="活动名称" name="title" value="{{$activity->title}}"></br>
            @include('vendor.ueditor.assets')
            <label for="">
                活动开始时间:
            </label>
            <input type="datetime-local" name="start_time" class="form-control" value="{{date('Y-m-d\TH:i:s',strtotime($activity->start_time))}}"><br>
            <label for="">
                活动结束时间:
            </label>
            <input type="datetime-local" name="end_time" class="form-control" value="{{date('Y-m-d\TH:i:s',strtotime($activity->end_time))}}"><br>
            {{--ueditor编辑器--}}
        <!-- 实例化编辑器 -->
            <script type="text/javascript">
                var ue = UE.getEditor('container');
                ue.ready(function() {
                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                });
            </script>
            <!-- 编辑器容器 -->
            <script id="container" name="content" type="text/plain">{!! $activity->content !!}</script>
                验证码:
            </label>
            <input id="captcha" class="form-control" name="captcha" >
            <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">

            <input type="hidden" name="status" value="0"><br><br><br>

            {{csrf_field()}}
            {{method_field('PATCH')}}
            <span style="float: right"><button class="btn btn-default" type="submit">确认</button></span>
            <br><br><br>
        </form>
    </div>



@endsection
