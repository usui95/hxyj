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

        #del {
            position: fixed;
            background: #efefef;
            top: 50%;
            left: 50%;
            margin-top: -101px;
            margin-left: -217px;
            text-align: center;
            display: none;
            padding:70px;
            border: 8px solid #ff0000;
        }

        h2 {
            text-align: left;
            font-size: 15px;
            font-weight: 800;
        }
    </style>
    <ol class="breadcrumb" style="background: #5e87ab;">
        <li>
            <a href="#">首页</a>
        </li>

        <li>
            <a href="#">商品管理</a>
        </li>
        <li class="active">商品列表</li>
    </ol>
    <table class="table table-striped" id="res">
        <tr>
            <th>商品ID</th>
            <th>商品类型</th>
            <th>商品名称</th>
            <th>logo地址</th>
            <th>跳转地址</th>
            <th>更新时间</th>
            <th>编辑时间</th>
        </tr>

        @foreach ($goodsCategory as $Category)
            <tr>
                <td>{{$Category->id}}</td>
                <td>{{$Category->category_id}}</td>
                <td>{{$Category->name}}</td>
                <td>{{$Category->logo}}</td>
                <td>{{$Category->url}}</td>
                <td>{{$Category->updated_at}}</td>
                <td>{{$Category->score}}</td>
                <td>{{$Category->created_at}}</td>

                <td>
                    <button type="button" class="put btn btn-success">{{ csrf_field() }}修改</button>
                    <button type="button" class="delete btn btn-danger">删除</button>
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
                <label for="name">商品类型:</label>
                <select class="form-control" id="name">
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
            <div class="form-group">
                <label for="nickname">商品名称:</label>
                <input type="text" class="form-control" id="nickname" placeholder=" 请输入商品别名"/>
            </div>
            <div class="form-group">
                <label for="description">logo地址:</label>
                <input type="text" class="form-control" id="description" placeholder=" 请输入商品描述"/>
            </div>
            <div class="form-group">
                <label for="price">跳转地址:</label>
                <input type="text" class="form-control" id="price" placeholder=" 请输入商品价格"/>
            </div>
            <button type="button" id="button" class="btn btn-default btn-success">确定修改</button>
            &nbsp;&nbsp;
            <button type="reset" class="btn btn-default btn-danger">重置</button>

            <button type="button" id="cancel" class="btn btn-default btn-warning">取消</button>
        </form>
    </div>

    <div id="del">
        <h2>提示：删除后将无法恢复</h2>
        <button type="button" id="canc" class="btn-success btn">&nbsp;取消&nbsp;</button>

        <button type="button" id="confirm" class="btn-danger btn">确定删除</button>
    </div>

    <script type="text/javascript">
        var PuT;
        var url;
        $("#res").on('click', '.put', function (e) {
            PuT = $(this).parent().prevAll().eq(7).html();//获取id
            console.log(PuT);
            url = '/admin/goodsCategories' + "/" + PuT;//把id加入到url地址传递
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    $("#id1").val(data.data.goodsCategory.id);
                    $("#name").val(data.data.goodsCategory.category_id);
                    $("#nickname").val(data.data.goodsCategory.name);
                    $("#description").val(data.data.goodsCategory.logo);
                    $("#price").val(data.data.goodsCategory.url);
                }
            });
            $("#put").show();
        });//点击出现一个隐藏的模态框 并且发送请求 取回参数
        $("#button").click(function () {
            var Json = {
                _token: $('input[name="_token"]').val(),
                category_id: $("#name").val(),
                name: $("#nickname").val(),
                logo: $("#description").val(),
                url: $("#price").val()
            };
            $.ajax({
                url: url,
                type: 'put',
                data: Json,
                datatype: 'json',
                success: function (data) {
                    alert(data.msg);
                    console.log(data);
                    $("#put").hide();
                    window.location.reload();
                }
            });
        });

        var PT = null;
        $("#res").on('click', '.delete', function (e) {
            $("#del").show();
            PT = $(this).parent().prevAll().eq(7).html();//获取id
        });
        $("#confirm").click(function () {
            url = '/admin/goodsCategories' + "/" + PT;//把id加入到url地址传递
            $.ajax({
                url: url,
                type: 'delete',
                data: {
                    _token: $("input[name='_token']").val()
                },
                success: function (data) {
                    alert(data.msg);
                    console.log(data);
                    $("#del").hide();
                    window.location.reload();
                }
            });
        });
        $("#canc").click(function () {
            $("#del").hide();
        });
        $("#cancel").click(function () {
            $("#put").hide();
        });

        //执行删除
    </script>

@endsection