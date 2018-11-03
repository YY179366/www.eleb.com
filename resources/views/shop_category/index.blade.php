@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <h1 style="text-align: center">商家类型页面</h1>
<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>分类名称</th>
        <th>分类图片</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    @foreach($shop_categories as $shop_category)
    <tr>
        <td>{{$shop_category->id}}</td>
        <td>{{$shop_category->name}}</td>
        <td><img src="{{$shop_category->logo}}" alt="" style="width: 80px;"></td>
        <td>{{$shop_category->status?'显示':'隐藏'}} </td>
        <td>
            {{--修改--}}
            @can('shop_category_update')
            <a href="{{route("shop_category.edit",[$shop_category])}}"><button class="btn btn-primary btn-xs"><span>编辑</span></button></a>
            @endcan
            {{--删除--}}
            @can('shop_category_delete')
            <form action="{{route('shop_category.destroy',[$shop_category])}}" method="post">
                {{method_field('DELETE')}}
                {{csrf_field()}}
                <button class="btn btn-danger btn-xs">删除</button>
            </form>
                @endcan
        </td>
    </tr>
        @endforeach
    {{--添加--}}
    @can('shop_category_create')
    <tr>
        <td colspan="5" style="text-align: center">
            <a href="{{route('shop_category.create')}}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
        </td>
    </tr>
        @endcan
</table>
    {{$shop_categories->links()}}
@endsection
