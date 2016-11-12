@extends('admin.layout')
@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="#">首页</a>
        </li>

        <li>
            <a href="#">商户管理</a>
        </li>
        <li class="active">列表</li>
    </ol>
<table class="table table-striped" id="res">
    <tr>
        <th>商品名称</th>
        <th>商品别名</th>
        <th>商品描述</th>
        <th>商品价格</th>
        <th>商品种类</th>
        <th>商品评分</th>
        <th>商品评价</th>
        <th>创建时间</th>
    </tr>

    @foreach ($goods as $goodsq)
        <tr>
            <td>{{$goodsq->name}}</td>
            <td>{{$goodsq->nickname}}</td>
            <td>{{$goodsq->description}}</td>
            <td>{{$goodsq->price}}</td>
            <td>{{$goodsq->category}}</td>
            <td><img src="{{$goodsq->score}}" height="50px"></td>
            <td>{{$goodsq->comment}}</td>
            <td>{{$goodsq->create_time}}</td>
        </tr>
    @endforeach
</table>
</div>

@endsection