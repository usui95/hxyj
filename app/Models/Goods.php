<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    // 商品类型
    const CATEGORY_CIGARETTE = 1; // 香烟
    const CATEGORY_WINE = 2; // 白酒
    const CATEGORY_RED_WINE = 3; // 红酒
    public $timestamps = false;

    public function goodsScore()
    {
        return $this->hasOne('App\Models\GoodsScore');
    }
    public function goodsDetail()
     {
        return $this->hasOne('App\Models\GoodsDetail');
    }
    public function isCigarette()
    {
        return (int)$this->category_id === GOODS_CIGARETTE;
    }
    public function isWine()
    {
        return (int)$this->category_id === GOODS_WINE;
    }
    public function isRedWine()
    {
      return (int)$this->category_id === GOODS_RED_WINE;
    }
}
