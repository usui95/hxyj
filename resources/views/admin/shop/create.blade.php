@extends('admin.layout')

@section('content')
    <style type="text/css">
        .rela{
            position: relative;
        }
        .abs{
            position: absolute;
            top: 251px;
            left: 10px;
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
        <li class="active">新增</li>
    </ol>
    <div class="rela">
        <div class="abs">
            <form id="uploadForm" enctype="multipart/form-data">
                    <input id="file" required  type="file" name="photo" value="" width="75px" />

                {{ csrf_field() }}
            </form>
        </div>

    <form role="form" id="form" enctype="multipart/form-data">
        {{ csrf_field() }}
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

            <input type="text" required class="form-control" id="logo" placeholder="" disabled>
        </div>
        <div class="form-group">
            <label for="tel">手机号码:</label>
            <input type="tel" required class="form-control" id="tel" placeholder="请输入联系信息">
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
                        $("#logo").val(data.data.url);
                        $("#file").val("");
                    }
                })
            }
          });

        $('#submit').click(function () {
            if ($("#name").val() == "" || $("#address").val() == "" || $("#tel").val() == "" || $("#logo").val == "" || $("#manager").val() == "") {
                alert(" 请输入完整的信息");
                return false;
            }
            else {
                var jsonAdmin = {
                    _token: $('input[name="_token"]').val(),
                    name: $("#name").val(),
                    tel: $("#tel").val(),
                    manager: $("#manager").val(),
                    logo: $("#logo").val(),
                    address: $("#address").val()
                }
                $.ajax({
                    url: '/admin/shops',
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

