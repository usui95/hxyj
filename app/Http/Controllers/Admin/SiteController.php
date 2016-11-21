<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

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
            return response()->json(['msg' => '用户不存在'], 403);
        }

        // 用户密码是否存在
        if (!$admin->isPasswordMatched($input['password'])) {
            return response()->json(['msg' => '密码错误'], 403);
        }

        // 执行
        $admin->iLoginSoIamVeryHappy();

        // session
        $admin->iLoginSoINeedSetSession($request);

        // 发送
        return response()->json([
            'msg' => '登录成功',
        ]);
    }

    public function doLogout(Request $request)
    {
        // 执行
        // 删除session记录
        $request->session()->clear();

        // 发送
        return response()->json(['msg' => 'ok']);
    }

    public function login(Request $request)
    {
        if ($request->session()->get('role') === 'admin') {
            return redirect('admin');
        }

        return view('admin.site.login');
    }
}
