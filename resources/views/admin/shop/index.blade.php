@extends('admin.layout')

@section('content')

    <style type="text/css">
        #put {
            position: fixed;
            width: 800px;
            margin: 0 auto;
            padding: 100px;
            z-index: 100000;
            top: 50px;
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
        .abs{
            position: absolute;
            top: 424px;
            left: 112px;
        }
        input[type=file]{
            width:71px;
            background: #000;
            color: #FFFFFF;
        }
        #logo{
            padding-left:90px;
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
    <form class="form-inline" role="form" method="get">
        {{ csrf_field() }}
        <div class="form-group">手机号码：
            <label class="sr-only" for="exampleInputPassword2">手机号码:</label>
            <input type="tel" class="form-control" name="tel" id="exampleInputPassword2" placeholder="查询手机号码">
        </div>
        <button type="submit" class="btn btn-success">查询</button>
    </form>
    <div id="put">
        <div class="abs">
            <form id="uploadForm" enctype="multipart/form-data">
                <input id="file" required  type="file" name="photo" value="" width="75px" />

                {{ csrf_field() }}
            </form>
        </div>
        <form role="form" id="form" enctype="multipart/form-data">

            <div class="form-group">
                <label for="name1">ID:</label>
                <input type="text" required class="form-control" id="id1" value="" disabled>
            </div>


            <div class="form-group">
                <label for="name">店名:</label>
                <input type="text" required class="form-control" id="name" placeholder=" 请输入店名">
            </div>
            <div class="form-group">
                <label for="manager">负责人信息:</label>
                <input type="text" required class="form-control" id="manager" placeholder="请输入负责人信息">
            </div>

            <div class="form-group">
                <label for="address">地址:</label>
                <input type="text" required class="form-control" id="address" placeholder="请输入店铺地址">
            </div>
            <div class="form-group">
                <label for="logo">店铺LOGO:</label>
                <input type="text" required class="form-control" id="logo" placeholder="请输入店铺LOGO" disabled>
            </div>
            <div class="form-group">
                <label for="tel">手机号码:</label>
                <input type="tel" required class="form-control" id="tel" placeholder="请输入联系信息">
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
    <div class="container topa">
        <table class="table table-striped" id="res">
            <tr>
                <th>店铺ID</th>
                <th>店名</th>
                <th>管理人员</th>
                <th>手机号码</th>
                <th>创建时间</th>
                <th>门店LOGO</th>
                <th>店铺地址</th>
                <th>操作</th>
            </tr>

            @foreach ($shops as $shop)
                <tr>
                    <td>{{$shop->id}}</td>
                    <td>{{$shop->name}}</td>
                    <td>{{$shop->manager}}</td>
                    <td>{{$shop->tel}}</td>
                    <td>{{$shop->create_time}}</td>
                    <td><img src="{{$shop->logo}}" height="50px"></td>
                    <td>{{$shop->address}}</td>
                    <td>
                        <button type="button" class="put btn btn-success">{{ csrf_field() }}修改</button>
                        <button type="button" class="delete btn btn-danger">删除</button>
                    </td>
                </tr>
            @endforeach
        </table>
        {{$shops->links()}}
    </div>
    <script type="text/javascript">
        $("#file").blur(function() {
            if($("#file").val()==""){
                return false;
            }
            else{

                $.ajax({
                    url: '/photos',
                    type: 'POST',
                    cache: false,
                    data: new FormData($('#uploadForm')[0]),
                    processData: false,
                    contentType: false,
                    success:function(data){
                        $("#logo").val(data.data.url);
                        $("#file").val("");
                    }
                })
            }
        });




        var PuT;
        var url;
        $("#res").on('click', '.put', function (e) {
            PuT = $(this).parent().prevAll().eq(6).html();//获取id
            url = '/admin/shops' + "/" + PuT;//把id加入到url地址传递
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    $("#id1").val(data.data.shop.id);
                    $("#name").val(data.data.shop.name);
                    $("#manager").val(data.data.shop.manager);
                    $("#tel").val(data.data.shop.tel);
                    $("#logo").val(data.data.shop.logo);
                    $("#address").val(data.data.shop.address);
                }
            })
            $("#put").show();
        })//点击出现一个隐藏的模态框 并且发送请求 取回参数
        $("#button").click(function () {
            console.log(PuT);
            var JSon = {
                _token: $('input[name="_token"]').val(),
                name: $("#name").val(),
                tel: $("#tel").val(),
                manager: $("#manager").val(),
                logo: $("#logo").val(),
                address: $("#address").val()
            }
            console.log(url);
            $.ajax({
                url: url,
                type: 'put',
                data: JSon,
                datatype: 'json',
                success: function (data) {
                    alert(data.msg);
                    $("#put").hide();
                    window.location.reload();
                }
            })
        });
        $("#cancel").click(function () {
            $("#put").hide();
        });
        var PT = null;
        $("#res").on('click', '.delete', function (e) {
            $("#del").show();
            PT = $(this).parent().prevAll().eq(6).html();//获取id
        });
        $("#confirm").click(function () {
            url = '/admin/shops' + "/" + PT;//把id加入到url地址传递
            $.ajax({
                url: url,
                type: 'delete',
                data: {
                    _token: $("input[name='_token']").val()
                },
                success: function (data) {
                    alert(data.msg);
                    $("#del").hide();
                    window.location.reload();
                }
            });
        });
        $("#canc").click(function () {
            $("#del").hide();
        });
        //
        // 执行删除

    </script>
@endsection