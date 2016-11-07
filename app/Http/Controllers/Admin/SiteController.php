<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function login(Request $request)
    {
        // 拦截 @todo
        $input = $request->all();

        // 过滤
        // 用户是否存在
        $admin = 1;

        // 用户密码是否存在

        // 执行

        // 发送
        return response()->json([
            'msg' => '登录成功',
        ]);
    }
}
