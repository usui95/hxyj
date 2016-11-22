@extends('admin.layout')
@section('content')
    <style type="text/css">
        .rela{
            position: relative;
        }
        .abs{
            position: absolute;
            top: 104px;
            left: 10px;
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
        <li>首页</li>
        <li>九宫格</li>
        <li>九宫格新增</li>
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
            <label for="name">商品名称:</label>
            <input type="text" id="name" class="form-control"  placeholder=" 请输入商品名称"/>
        </div>
        <div class="form-group">
            <label for="thumb">图片:</label>
            <input type="text" class="form-control" id="thumb" placeholder="  " disabled />
        </div>
        <div class="form-group">
            <label for="url">跳转地址:</label>
            <input type="text" class="form-control" id="url" placeholder=" 请输入跳转地址"/>
        </div>
        <div class="form-group">
            <label for="weight">权重:</label>
            <input type="text" id="weight" class="form-control" placeholder=" 请设置权重"/>
        </div>

        <button type="button" id="submit" class="btn btn-default btn-success">提交</button>
        <button type="reset" class="btn btn-default btn-danger">重置</button>
    </form>
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



        $(function(){
            $('#submit').click(function () {
                    if ($("#name").val() == "" || $("#thumb").val() == "" || $("#url").val == "" || $("#weight").val() == "") {
                        alert(" 请输入完整的信息");
                        return false;
                    }
                    else {
                        var Json = {
                            _token: $('input[name="_token"]').val(),
                            name: $("#name").val(),
                            thumb: $("#thumb").val(),
                            url: $("#url").val(),
                            weight: $("#weight").val()
                        }
                    }
                    console.log(Json);
                    $.ajax({
                        url: '/admin/ninePatch',
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
            })
    </script>


@endsection