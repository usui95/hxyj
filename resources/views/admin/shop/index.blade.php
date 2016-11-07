@extends('admin.layout')

@section('content')

    <style type="text/css">
        #put{
            position: absolute;
            width: 800px;
            padding:100px;
            right:15%;
            background: #efefef;
            display: none;
        }
    </style>

    <ol class="breadcrumb">
        <li>
            <a href="#">首页</a>
        </li>

        <li>
            <a href="#">Library</a>
        </li>
        <li class="active">Data</li>
    </ol>
    <form class="form-inline" role="form">
        <div class="form-group">姓名：
            <label class="sr-only" for="exampleInputEmail2">姓名:</label>
            <input type="text" class="form-control" id="exampleInputEmail2" placeholder="姓名">
        </div>
        <div class="form-group">创建日期：
            <div class="input-group">
                <input class="form-control" type="date" placeholder="日期">
            </div>
        </div>
        <div class="form-group">职位：
            <label class="sr-only" for="exampleInputPassword2">职位:</label>
            <input type="text" class="form-control" id="exampleInputPassword2" placeholder="查询职位">
        </div>
        <button type="button" class="btn btn-success">查询</button>
    </form>
    <div id="put">
        <form role="form" id="form">

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
                <input type="text" required class="form-control" id="logo" placeholder="请输入店铺LOGO">
            </div>
            <div class="form-group">
                <label for="tel">手机号码:</label>
                <input type="tel" required class="form-control" id="tel" placeholder="请输入联系信息">
            </div>
            <button type="button" id="button" class="btn btn-default">确定修改</button>
            &nbsp;&nbsp;
            <button type="reset" class="btn btn-default">重置</button>

            <button type="button" id="cancel" class="btn btn-default">取消</button>
        </form>
    </div>
    <div class="container topa" >
        <table class="table table-striped" id="res" >
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
                    <td>{{$shop->logo}}</td>
                    <td>{{$shop->address}}</td>
                    <td>
                        <button type="button" class="put">{{ csrf_field() }}修改</button>
                        <button type="button" class="delete">删除</button>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>
    <script type="text/javascript">
        $("#res").on('click','.put',function(e){
            var PUT=$(this).parent().prevAll().eq(6).html();
            $.ajax({
                url:'/admin/shops/show/edit',
                type:'get',
                datatype:'json',
                data:{
                    _token:$('input[name="_token"]').val(),
                    id:PUT
                },
                success:function(data){
                    console.log(data);
                }
            })
            $("#put").show();
        })
        $("#cancel").click(function(){
            $("#put").hide();
        })
        //        $("#res").on('click','.delete',function(e){
        //           var DELETE=$(this).parent().prevAll().eq(6).html();
        //            $.ajax({
        //                url:'',
        //                type:'post',
        //                data:{
        //                    id:DELETE
        //                },
        //                success:function(){
        //                    alert("删除成功");
        //                }
        //            })
        //        })
    </script>
@endsection