<!doctype html>
<html lang="cn">

<head>
    <meta charset="UTF-8" />
    <title>后台管理</title>
    <link rel="shortcut icon" href="/image/admin/14.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="/css/admin/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/css/admin/index.css" />
    <script type="text/javascript" src="/js/admin/jquery-3.1.0.js"></script>

</head>
<body>
@include('admin.header')
@include('admin.nav')

<div class="row">
    @include('admin.sidebar')
    <div class="col-md-10">
        @yield('content')
    </div>
</div>
@include('admin.footer')
</body>
<script type="text/javascript" src="/js/admin/bootstrap.min.js"></script>
</html>
