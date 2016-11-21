<nav class="navbar navbar-default bdad" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/admin">首页</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#" id="quit">退出登录</a>
                    {{ csrf_field() }}
                </li>

            </ul> </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<script type="text/javascript">
    $("#quit").click(function(){
        $.ajax({
            url:'/admin/doLogout',
            type:'post',
            datatype:'json',
            data:$("input[name='_token']"),
            success:function(data){
                if(data.msg=='ok'){
                    window.location.href = "/admin/login";
                }
                else{
                    alert('请求失败，请稍后再试');
                }
            }
        })
    })
</script>