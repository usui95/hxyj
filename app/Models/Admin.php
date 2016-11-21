<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Admin extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $dateFormat = 'U';

    public $timestamps = false;

    public function isPasswordMatched($password)
    {
        return $this->password === $password; // 后期可以考虑增加salt字段的验证
    }

    public function iLoginSoIamVeryHappy() // 我登录成功啦
    {
        $this->last_login_time = time();
        $this->login_times += 1;
        $this->save();
    }

    public function iLoginSoINeedSetSession(Request $request) // 记录session
    {
        $request->session()->set('role', 'admin');
        $request->session()->set('id', $this->id);
        $request->session()->set('info', $this);
    }
}
