@extends('admin.layout')
@section('content')
    <table>
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
                <td>{{$ninePathes->thumb}}</td>
                <td>{{$ninePathes->url}}</td>
                <td>{{$ninePathes->weight}}</td>
                <td>{{$ninePathes->create_time}}</td>
                <td>
                    <button type="button" class="put">修改</button>
                    <button type="button" class="delete">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    <div id="put">
        <form>
        ID: <input type="text" id="id1"/>
        商品名字：<input type="text" id="name"/>
        商品图片：<input type="text" id="thumb"/>
        跳转地址：<input type="text" id="url"/>
        权重：<input type="text" id="weight"/>
        <button type="button">确定修改</button>
        <button type="button">重置</button>
        <button type="button">取消</button>
        </form>
    </div>
    <div id="del">
        <h2>提示：删除后将无法恢复</h2>
        <button type="button" id="canc" >&nbsp;取消&nbsp;</button>
        <button type="button" id="confirm" >确定删除</button>
    </div>
    <script>
        var Put;
        var url;
        $("#res").on('click', '.put', function (e) {
            Put = $(this).parent().prevAll().eq().html();
            url = '/admin/ninePatch' + "/" + Put;
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    $("#id1").val(data.data.goods.id);
                    $("#name").val(data.data.goods.name);
                    $("#thumb").val(data.data.goods.thumb);
                    $("#url").val(data.data.goods.url);
                    $("#weight").val(data.data.goods.weight);
                    $("#create_time").val(data.data.goods.create_time);
                }
            });
            $("#put").show();
        });


        $("#button").click(function () {
            var Json = {
                _token: $('input[name="_token"]').val(),
                name: $("#name").val(),
                thumb: $("#thumb").val(),
                url: $("#url").val(),
                weight: $("#weight").val(),
                create_time: $("#create_time").val()
            };
            $.ajax({
                url: 'admin/ninePatch/{id}',
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
        $("#res").on('click', 'delect', function (e) {
            $("#del").show();
            PT = $(this).parent().prevAll().eq(8).html();
        });
        $("#confirm").click(function(){
           url =  'admin/ninePatch/{id}' + "/" + PT;
            $.ajax({
                url: url,
                type: 'put',
                data: {
                    _token: $("input[name='_token']").val()
                },
                success: function (data) {
                    alert(data.del);
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
