@extends('admin.layout')
@section('content')
    <ol class="breadcrumb" style="background: #5e87ab;">
        <li>首页</li>
        <li>九宫格</li>
        <li>九宫格新增</li>
    </ol>
    <form>
        <div>
            <label for="name">商品名称:</label>
            <input type="text" id="name" placeholder=" 请输入商品名称"/>
        </div>
        <div>
            <label for="thumb">图片:</label>
            <input type="text" id="loge" placeholder=" "/>
        </div>
        <div>
            <label for="url">跳转地址:</label>
            <input type="text" id="urlAddress" placeholder=" "/>
        </div>
        <div>
            <label for="weight">权重:</label>
            <input type="text" id="urlAddress" placeholder=" "/>
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
                    $.ajax({
                        url: 'admin/ninePatch/create',
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