@extends('admin.layout')

@section('content')
    <ol class="breadcrumb" style="background: #5e87ab;">
        <li>
            <a href="/admin">首页</a>
        </li>
    </ol>
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
