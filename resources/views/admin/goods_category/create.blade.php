@extends('admin.layout')
@section('content')
    <ol class="breadcrumb" style="background: #5e87ab;">
        <li>
            <a href="#">首页</a>
        </li>

        <li>
            <a href="/admin/goodsCategories">九宫格</a>
        </li>
        <li class="active">九宫格新增</li>
    </ol>
    <form role="form" id="form">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">商品名称:</label>
            <input type="text" class="form-control" id="name" placeholder=" 请输入商品名称"/>
        </div>
        <div class="form-group">
            <label for="logo">logo地址:</label>
            <input type="text" class="form-control" id="logo" placeholder=" 请输入logo地址"/>
        </div>
        <div class="form-group">
            <label for="urlAddress">商品跳转地址:</label>
            <input type="text" class="form-control" id="urlAddress" placeholder=" 请输入页面跳转地址"/>
        </div>
        <div class="form-group">
            <label for="price">商品价格:</label>
            <input type="text" class="form-control" id="price" placeholder=" 请输入商品价格"/>
        </div>
        <div class="form-group">
        <select class="form-control" id="option">
            <option value="0">&lt;----请选择商品分类列表------&gt;</option>
            <option value="1">礼品套餐</option>
            <option value="2">礼品</option>
            <option value="3">香烟</option>
            <option value="4">茶叶</option>
            <option value="5">洋酒</option>
            <option value="6">红酒</option>
            <option value="7">老酒</option>
            <option value="8">零食</option>
            <option value="9">白酒</option>
        </select>
        </div>
        <button type="button" id="submit" class="btn btn-default btn-success">提交</button>
        <button type="reset" class="btn btn-default btn-danger">重置</button>
    </form>
    <script>
        $('#submit').click(function () {
            if ($("#name").val() == "" || $("#logo").val() == "" || $("#urlAddress").val == "" || $("#option option:selected").val() == "0") {
                alert(" 请输入完整的信息");
                return false;
            }
            else {
                var Json = {
                    _token: $('input[name="_token"]').val(),
                    name: $("#name").val(),
                    logo: $("#logo").val(),
                    category_id: $("#option option:selected").val(),
                    url: $("#urlAddress").val()
                }
            }
            $.ajax({
                url: '/admin/goodsCategories',
                type: 'post',
                data: Json,
                datatype: 'json',
                success: function (data) {
                    console.log(data);
                    if (data.msg == "已经存在,无需重复录入") {
                        alert(data.msg);
                    }
                    else {
                        alert(data.msg);
                        window.location.reload();
                    }
                }
            })
        })


    </script>

@endsection