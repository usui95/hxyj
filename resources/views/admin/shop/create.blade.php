@extends('admin.layout')

@section('content')
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
@endsection