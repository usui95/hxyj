@extends('admin.layout')

@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="/admin">首页</a>
        </li>
    </ol>
    {{--<form class="form-inline" role="form">--}}
        {{--<div class="form-group">姓名：--}}
            {{--<label class="sr-only" for="exampleInputEmail2">姓名</label>--}}
            {{--<input type="text" class="form-control" id="exampleInputEmail2" placeholder="姓名">--}}
        {{--</div>--}}
        {{--<div class="form-group">日期：--}}
            {{--<div class="input-group">--}}
                {{--<input class="form-control" type="date" placeholder="日期" id="data">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="form-group">手机号码：--}}
            {{--<label class="sr-only" for="exampleInputPassword2">手机号码</label>--}}
            {{--<input type="text" class="form-control" id="exampleInputPassword2" placeholder="查询手机号码">--}}
        {{--</div>--}}
        {{--<button type="button" id="query" class="btn btn-success">查询</button>--}}
    {{--</form>--}}
    {{--<div class="container topa">--}}
        {{--<table class="table table-striped">--}}
             {{--<tr>--}}
                {{--<th>店铺ID</th>--}}
                {{--<th>店名</th>--}}
                {{--<th>管理人员</th>--}}
                {{--<th>手机号码</th>--}}
                {{--<th>创建时间</th>--}}
                {{--<th>门店LOGO</th>--}}
                {{--<th>店铺地址</th>--}}
                {{--<th>操作</th>--}}
            {{--</tr>--}}
 {{--</table>--}}
    {{--</div>--}}
    <script type="text/javascript">
        $(document).ready(function(){
                $("#query").click(function(){
                    var JsonType={
                        name:$("#exampleInputEmail2").val(),
                        data:$("#data").val(),
                        tel:$("#exampleInputPassword2").val()
                    }
                   $.ajax({
                       url:'/admin/shops',
                       type:'get',
                       data:JsonType,
                       datatype:'json',
                        success:function(data){
                           console.log(data);
                        }
                   })
                });
        })

    </script>
@endsection
