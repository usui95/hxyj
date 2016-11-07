<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use SoftDeletes; // 开启软删除

    protected $dates = ['deleted_at']; // 软删除字段

    protected $dateFormat = 'U'; // 时间格式为时间戳

    public $timestamps = false; // 系统不自动维系created_at/updated_at
}
