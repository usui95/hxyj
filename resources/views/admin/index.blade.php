<!doctype html>
<html lang="cn">

	<head>
		<meta charset="UTF-8" />
		<title>后台管理</title>
		<link rel="shortcut icon" href="/image/admin/14.ico" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="/css/admin/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="/css/admin/index.css" />
	</head>
	<body>
		{{ csrf_field() }}
		<header>
			<img src="/image/admin/1.jpg" />
		</header>
		<nav class="navbar navbar-default bdad" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
              </button>
					<a class="navbar-brand" href="#">首页</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="#">切换用户</a>
						</li>
						<li>
							<a href="#">退出登录</a>
						</li>

					</ul </div>
					<!-- /.navbar-collapse -->
				</div>
				<!-- /.container-fluid -->
		</nav>
		<div class="row">
			<div class="col-md-2">
				<div class="sidebar-menu">
					<a href="#userMeun" class="nav-header bord menu-first collapsed" data-toggle="collapse">
                        <i class="icon-user-md icon-large"></i> &nbsp;商户管理
                    </a>
					<ul id="userMeun" class="nav nav-list collapse menu-second bd">
                        <li>
							<a href="#"><i class="icon-list"></i> 商户列表</a>
						</li>
						<li>
							<a href="#"><i class="icon-user"></i> 新增</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-10">
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
						<label class="sr-only" for="exampleInputEmail2">姓名</label>
						<input type="email" class="form-control" id="exampleInputEmail2" placeholder="姓名">
					</div>
					<div class="form-group">日期：
						<div class="input-group">
							<input class="form-control" type="date" placeholder="日期">
						</div>
					</div>
					<div class="form-group">职位：
						<label class="sr-only" for="exampleInputPassword2">职位</label>
						<input type="text" class="form-control" id="exampleInputPassword2" placeholder="查询职位">
					</div>
					<button type="submit" class="btn btn-success">查询</button>
				</form>
				<div class="container topa">
					<table class="table table-striped">
						<tr>
							<td>序号</td>
							<td>姓名</td>
							<td>职位</td>
							<td>**</td>
							<td>**</td>
							<td>**</td>
						</tr>

						<tr>
							<td>
							</td>
							<td>
							</td>
							<td>
							</td>
							<td>**</td>
							<td>**</td>
						</tr>
						<tr>
							<td>2</td>
							<td>**</td>
							<td>**</td>
							<td>**</td>
							<td>**</td>
							<td>**</td>
						</tr>
						<tr>
							<td>3</td>
							<td>**</td>
							<td>**</td>
							<td>**</td>
							<td>**</td>
							<td>**</td>
						</tr>
						<tr>
							<td>4</td>
							<td>**</td>
							<td>**</td>
							<td>**</td>
							<td>**</td>
							<td>**</td>
						</tr>
						<tr>
							<td>5</td>
							<td>**</td>
							<td>**</td>
							<td>**</td>
							<td>**</td>
							<td>**</td>
						</tr>
						<tr>
							<td>3</td>
							<td>**</td>
							<td>**</td>
							<td>**</td>
							<td>**</td>
							<td>**</td>
						</tr>
						<tr>
							<td>4</td>
							<td>**</td>
							<td>**</td>
							<td>**</td>
							<td>**</td>
							<td>**</td>
						</tr>
						<tr>
							<td>5</td>
							<td>**</td>
							<td>**</td>
							<td>**</td>
							<td>**</td>
							<td>**</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="/js/admin/jquery-3.1.0.js"></script>
	<script type="text/javascript" src="/js/admin/bootstrap.min.js"></script>
</html>
