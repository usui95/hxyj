<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Photo extends Model
{
    public $timestamps = false;

    public static function dir()
    {
        $path = md5(time());
        $dir1 = substr($path, 0, 2);
        $dir2 = $dir1 . '/' . substr($path, 2, 2);
        return $dir2;
    }

    public static function filename(UploadedFile $photo)
    {
        $ext = $photo->extension();
        return self::dir() . '/' . md5(microtime()) . '.' . $ext;
    }
}
