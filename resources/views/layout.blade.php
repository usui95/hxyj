<!DOCTYPE html>
<html lang="zh-CN" style="font-size: 52px;">
<head>
    <title>{{ config('app.name') }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=0">
    <meta name="description" content="{{ config('app.description') }}">
    <meta name="keywords" content="{{ config('app.keywords') }}">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <script type="text/javascript" src="/js/admin/jquery-3.1.0.js"></script>
    @section('css')
    <link rel="stylesheet" href="{{ elixir('css/index.css') }}">
    @show
    @yield('topjs')
</head>

<body>
@yield('body')
@yield('js')
</body>
</html>
