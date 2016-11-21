@extends('admin.layout')

@section('content')
    <style type="text/css">
        .rela{
            position: relative;
        }
        .abs{
            position: absolute;
            top: 105px;
            left: 10px;
        }
        input[type=file]{
            width:71px;
            background: #000;
            color: #FFFFFF;
        }
        #imgSrc{
            padding-left:90px;
        }
        </style>
    <ol class="breadcrumb" style="background: #5e87ab;">
        <li>
            <a href="#">首页</a>
        </li>
        <li>
            <a href="#">幻灯片管理</a>
        </li>
        <li class="active">幻灯片新增</li>
    </ol>
    <div class="rela">
        <div class="abs">
            <form id="uploadForm" enctype="multipart/form-data">
                <input id="file" required  type="file" name="photo" value="" width="75px" />

                {{ csrf_field() }}
            </form>
        </div>
    <form role="form" id="form">
        {{ csrf_field() }}


        <div class="form-group">
            <label for="name">名字:</label>
            <input type="text" required class="form-control" id="name" placeholder="请输入幻灯片名">
        </div>
        <div class="form-group">
            <label for="imgSrc">图片地址:</label>
            <input type="tel" required class="form-control" id="imgSrc" placeholder=" " disabled>
        </div>
        <div class="form-group">
            <label for="Url">跳转地址:</label>
            <input type="text" required class="form-control" id="Url" placeholder="请输入跳转地址">
        </div>

        <button type="button" id="submit" class="btn btn-default btn-success">提交</button>
        &nbsp;&nbsp;
        <button type="reset" class="btn btn-default btn-danger">重置</button>
    </form>
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
                        $("#imgSrc").val(data.data.url);
                        $("#file").val("");
                    }
                })
            }
        });




        $('#submit').click(function () {
          if ($("#name").val() == "" ||$("#url").val() == "" || $("#imgSrc").val() == "") {
                alert(" 请输入完整的信息");
                return false;
            }
            else {
                var jsonAdmin = {
                    _token: $('input[name="_token"]').val(),
                    name: $("#name").val(),
                    src: $("#imgSrc").val(),
                    url: $("#Url").val()
                }
                $.ajax({
                    url: '/admin/slide',
                    type: 'post',
                    data: jsonAdmin,
                    datatype: 'json',
                    success: function (data) {
                        alert(data.msg);
                        $("#form input").val("");
                        window.location.reload();
                    }
                })
            }
        })
    </script>
@endsection
