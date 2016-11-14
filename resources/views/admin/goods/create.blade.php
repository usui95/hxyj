@extends('admin.layout')
@section('content')
    <ol class="breadcrumb" style="background: #5e87ab;">
        <li>
            <a href="#">首页</a>
        </li>

        <li>
            <a href="#">商品管理</a>
        </li>
        <li class="active">商品新增</li>
    </ol>
    <form role="form" id="form">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">商品名字:</label>
            <input type="text" class="form-control" id="name" placeholder=" 请输入商品名字"/>
        </div>
        <div class="form-group">
            <label for="nickname">商品别名:</label>
            <input type="text" class="form-control" id="nickname" placeholder=" 请输入商品别名"/>
        </div>
        <div class="form-group">
            <label for="description">商品描述:</label>
            <input type="text" class="form-control" id="description" placeholder=" 请输入商品描述"/>
        </div>
        <div class="form-group">
            <label for="price">商品价格:</label>
            <input type="text" class="form-control" id="price" placeholder=" 请输入商品价格"/>
        </div>
        <div class="form-group">
            <label for="category">商品种类:</label>
            <input type="text" class="form-control" id="category" placeholder=" 请输入商品种类"/>
        </div>
        <div class="form-group">
            <label for="score">商品评分:</label>
            <input type="text" class="form-control" id="score" placeholder=" 请输入商品评分"/>
        </div>
        <div class="form-group">
            <label for="comment">商品评价:</label>
            <input type="text" class="form-control" id="comment" placeholder=" 请输入商品评价"/>
        </div>

        <button type="button" id="submit" class="btn btn-default btn-success">提交</button>
        <button type="reset" class="btn btn-default btn-danger">重置</button>
    </form>
    <script>
        $('#submit').click(function () {
            if ($("#name").val() == "" || $("#nickname").val() == "" || $("#description").val == "" || $("#price").val() == ""
                    || $("#category").val == "" || $("#score").val() == "" || $("#comment").val() == "") {
                alert(" 请输入完整的信息");
                return false;
            }
            else {
                var Json = {
                    _token: $('input[name="_token"]').val(),
                    name: $("#name").val(),
                    nickname: $("#nickname").val(),
                    description: $("#description").val(),
                    price: $("#price").val(),
                    category: $("#category").val(),
                    score: $("#score").val(),
                    comment: $("#comment").val()
                }
            }
            $.ajax({
                url: '/admin/goods',
                type: 'post',
                data: Json,
                datatype: 'json',
                success: function (data) {
                    if (data.msg == "该商品已添加，无需重复添加") {
                        alert(data.msg);
                    }
                    else {
                        alert(data.msg);
                        $("#form input").val("");
                        window.location.reload();
                    }
                 }
            })
        })


    </script>

@endsection