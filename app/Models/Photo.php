<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Photo extends Model
{

    const MAX_SIZE = 5 * 1024 * 1024;
    const EXTENSIONS = ['jpg', 'jpeg', 'png'];

    protected $dates = ['deleted_at'];
    protected $dateFormat = 'U';

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

    public static function isSizeOkay(UploadedFile $photo)
    {
        return $photo->getSize() <= 5 * 1024 * 1024 ? true : false;
    }

    public static function isExtensionOkay(UploadedFile $photo)
    {
        return in_array($photo->extension(), self::EXTENSIONS) ? true : false;
    }

}
