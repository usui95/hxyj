<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{

    public function doLogin(Request $request)
    {
        // 拦截 @todo
        $input = $request->all();

        // 过滤
        // 用户是否存在
        $admin = Admin::where('tel', $input['tel'])->first();
        if (empty($admin)) {
            return response()->json(['msg' => '用户不存在']);
        }

        // 用户密码是否存在
        if (!$admin->isPasswordMatched($input['password'])) {
            return response()->json(['msg' => '密码错误']);
        }

        // 执行
        $admin->iLoginSoIamVeryHappy();

        // 发送
        return response()->json([
            'msg' => '登录成功',
        ]);
    }

    public function login(Request $request)
    {
        return view('admin.site.login');
    }
}
