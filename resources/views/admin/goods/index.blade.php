@extends('admin.layout')
@section('content')
    <style type="text/css">
        #put {
            position: fixed;
            width: 800px;
            padding: 100px;
            z-index: 100000;
            top: 10%;
            left: 20%;
            background: #88b5dc;
            display: none;
        }
    </style>
    <ol class="breadcrumb" style="background: #5e87ab;">
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
            <th>商品ID</th>
            <th>商品名称</th>
            <th>商品别名</th>
            <th>商品描述</th>
            <th>商品价格</th>
            <th>商品种类</th>
            <th>商品评分</th>
            <th>商品评价</th>
            <th>创建时间</th>
            <th>商品操作</th>
        </tr>

        @foreach ($goods as $goodsq)
            <tr>
                <td>{{$goodsq->id}}</td>
                <td>{{$goodsq->name}}</td>
                <td>{{$goodsq->nickname}}</td>
                <td>{{$goodsq->description}}</td>
                <td>{{$goodsq->price}}</td>
                <td>{{$goodsq->category}}</td>
                <td><img src="{{$goodsq->score}}" height="50px"></td>
                <td>{{$goodsq->comment}}</td>
                <td>{{$goodsq->create_time}}</td>
                <td>
                    <button type="button" class="put">{{ csrf_field() }}修改</button>
                    <button type="button" class="delete">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    </div>

    <div id="put">
        <form role="form" id="form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name1">ID:</label>
                <input type="text" required class="form-control" id="id1" value="" disabled>
            </div>
            <div class="form-group">
                <label for="name">商品名字:</label>
                <input type="text" class="form-control" id="name" placeholder=" 请输入商品名字" />
            </div>
            <div class="form-group">
                <label for="nickname">商品别名:</label>
                <input type="text" class="form-control" id="nickname" placeholder=" 请输入商品别名" />
            </div>
            <div class="form-group">
                <label for="description">商品描述:</label>
                <input type="text" class="form-control" id="description" placeholder=" 请输入商品描述" />
            </div>
            <div class="form-group">
                <label for="price">商品价格:</label>
                <input type="text" class="form-control" id="price" placeholder=" 请输入商品价格" />
            </div>
            <div class="form-group">
                <label for="category">商品种类:</label>
                <input type="text" class="form-control" id="category" placeholder=" 请输入商品种类" />
            </div>
            <div class="form-group">
                <label for="score">商品评分:</label>
                <input type="text" class="form-control" id="score" placeholder=" 请输入商品评分" />
            </div>
            <div class="form-group">
                <label for="comment">商品评价:</label>
                <input type="text" class="form-control" id="comment" placeholder=" 请输入商品评价" />
            </div>
            <button type="button" id="button" class="btn btn-default">确定修改</button>
            &nbsp;&nbsp;
            <button type="reset" class="btn btn-default">重置</button>

            <button type="button" id="cancel" class="btn btn-default">取消</button>
        </form>
    </div>



    <script type="text/javascript">
        var PuT;
        var url;
        $("#res").on('click', '.put', function (e) {
            url = window.location.href;//获取当前页面的url
            PuT = $(this).parent().prevAll().eq(8).html();//获取id
            url = url + "/" + PuT;//把id加入到url地址传递
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    $("#id1").val(data.data.goods.id);
                    $("#name").val(data.data.goods.name);
                    $("#nickname").val(data.data.goods.nickname);
                    $("#description").val(data.data.goods.description);
                    $("#price").val(data.data.goods.price);
                    $("#category").val(data.data.goods.category);
                    $("#score").val(data.data.goods.score);
                    $("#comment").val(data.data.goods.comment);
                }
            });
            $("#put").show();
        });//点击出现一个隐藏的模态框 并且发送请求 取回参数
        $("#button").click(function () {
            var Json = {
                _token: $('input[name="_token"]').val(),
                name: $("#name").val(),
                nickname: $("#nickname").val(),
                description: $("#description").val(),
                price: $("#price").val(),
                category: $("#category").val(),
                score: $("#score").val(),
                comment: $("#comment").val()
            };
            $.ajax({
                url: url,
                type: 'put',
                data: Json,
                datatype: 'json',
                success: function (data) {
//                    alert(data.msg);
                 console.log(data);
                    $("#put").hide();
//                    window.location.reload();
                }
            });
        });
        $("#cancel").click(function () {
            $("#put").hide();
        });
        $("#res").on('click', '.delete', function (e) {
            url = window.location.href;//获取当前页面的url
            PuT = $(this).parent().prevAll().eq(8).html();//获取id
            url = url + "/" + PuT;//把id加入到url地址传递
            $.ajax({
                url: url,
                type: 'delete',
                data: {
                    _token: $("input[name='_token']").val()
                },
                success: function (data) {
                    alert(data.msg);
                    window.location.reload();
                }
            });
        });
        //执行删除
    </script>

@endsection