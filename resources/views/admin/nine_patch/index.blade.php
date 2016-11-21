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
            padding: 70px;
            border: 8px solid #ff0000;
        }

        h2 {
            text-align: left;
            font-size: 15px;
            font-weight: 800;
        }
        .abs{
            position: absolute;
            top: 279px;
            left: 112px;
        }
        input[type=file]{
            width:71px;
            background: #000;
            color: #FFFFFF;
        }
        #thumb{
            padding-left:90px;
        }
    </style>
    <ol class="breadcrumb" style="background: #5e87ab;">
        <li>
            <a href="#">首页</a>
        </li>
        <li>
            <a href="#">九宫格</a>
        </li>
        <li class="active">九宫格列表</li>
    </ol>
    <table class="table table-striped" id="res">
        <tr>
            <th>九宫格ID</th>
            <th>名字</th>
            <th>图片</th>
            <th>跳转地址</th>
            <th>权重</th>
            <th>创建时间</th>
        </tr>
        @foreach($ninePatch as $ninePathes)
            <tr>
                <td>{{$ninePathes->id}}</td>
                <td>{{$ninePathes->name}}</td>
                <td><img src="{{$ninePathes->thumb}}" width="50px" /></td>
                <td>{{$ninePathes->url}}</td>
                <td>{{$ninePathes->weight}}</td>
                <td>{{$ninePathes->create_time}}</td>
                <td>
                    <button type="button" class="put btn btn-success">{{ csrf_field() }}修改</button>
                    <button type="button" class="delete btn btn-danger">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    {{$ninePatch->links()}}
    </div>

    <div id="put">
        <div class="abs">
            <form id="uploadForm" enctype="multipart/form-data">
                <input id="file" required  type="file" name="photo" value="" width="75px" />

                {{ csrf_field() }}
            </form>
        </div>
        <form role="form" id="form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name1">九宫格ID:</label>
                <input type="text" required class="form-control" id="id" value="" disabled>
            </div>
            <div class="form-group">
                <label for="name1">商品名字：</label>
                <input type="text" class="form-control" id="name" placeholder=" 请输入商品名称"/>
            </div>
            <div class="form-group">
                <label for="name1">商品图片：</label>
                <input type="text" class="form-control" id="thumb" placeholder=" 请输入商品图片" disabled>
            </div>
            <div class="form-group">
                <label for="name1">跳转地址：</label>
                <input type="text" class="form-control" id="url" placeholder=" 请输入跳转地址">
            </div>
            <div class="form-group">
                <label for="name1">权重：</label>
                <input type="text" class="form-control" id="weight" placeholder=" 请输入商品权重">
            </div>
            <button type="button" id="button" class="btn btn-default btn-success">确定修改</button>
            <button type="button" class="btn btn-default btn-danger">重置</button>
            <button type="button" id="cancel" class="btn btn-default btn-warning">取消</button>
        </form>
    </div>

    <div id="del">
        <h2>提示：删除后将无法恢复</h2>
        <button  type="button" id="canc" class="btn-success btn">&nbsp;取消&nbsp;</button>
        <button type="button" type="button" id="confirm" class="btn-danger btn">确定删除</button>
    </div>
    <script>
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
                        $("#thumb").val(data.data.url);
                        $("#file").val("");
                    }
                })
            }
        });


        var PuT;
        var url;
        $("#res").on('click', '.put', function (e) {
            PuT = $(this).parent().prevAll().eq(5).html();
            console.log(PuT);
            url = '/admin/ninePatch' + "/" + PuT;
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    $("#id").val(data.data.ninePatch.id);
                    $("#name").val(data.data.ninePatch.name);
                    $("#thumb").val(data.data.ninePatch.thumb);
                    $("#url").val(data.data.ninePatch.url);
                    $("#weight").val(data.data.ninePatch.weight);
                    $("#create_time").val(data.data.ninePatch.create_time);

                }
            });
            $("#put").show();
        });
        $("#button").click(function () {
            var Json = {
                _token: $('input[name="_token"]').val(),
                id:$("#id").val(),
                name: $("#name").val(),
                url: $("#url").val(),
                thumb: $("#thumb").val(),
                weight: $("#weight").val(),
                create_time: $("#create_time").val()
            };
            $.ajax({
                url: url,
                type: 'put',
                data: Json,
                datatype: 'json',
                success: function (data) {
                    alert(data.msg);
                    $("#put").hide();
                    window.location.reload();
                }
            });
        });


        var PT = null;
        $("#res").on('click', '.delete', function (e) {
            $("#del").show();
            PT = $(this).parent().prevAll().eq(5).html();//获取id
        });
        $("#confirm").click(function () {
            url = '/admin/ninePatch' + "/" + PT;//把id加入到url地址传递
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
    </script>
@endsection


