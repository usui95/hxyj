<?php

namespace App\Http\Controllers;

use App\Models\NinePatch;
use App\Models\Shop;
use App\Models\Slide;
use App\Models\GoodsCategory;
use App\Models\Goods;

class IndexController extends Controller
{
    public function home()
    {
        // 幻灯片
        $slides = Slide::all();

        // 获取九宫格内容
        $ninePatch = NinePatch::all();

        // 店铺列表
        $shops = Shop::all();

        return view('index/home', [
          'ninePatch' => $ninePatch,
          'shops' => $shops,
          'slides' => $slides,
        ]);
    }

    public function category()
    {
        // 获取分类信息
        $goodsCategories = GoodsCategory::all();

        // 分类数组
        $categories = [];
        foreach ($goodsCategories as $goods) {
            switch ($goods->category_id) {
                case GOODS_COMBO:
                    $categories['礼品套餐'][] = $goods;
                    break;
                case GOODS_GIFT:
                    $categories['礼品'][] = $goods;
                    break;
                case GOODS_CIGARETTE:
                    $categories['香烟'][] = $goods;
                    break;
                case GOODS_TEA:
                    $categories['茶叶'][] = $goods;
                    break;
                case GOODS_F_WINE:
                    $categories['洋酒'][] = $goods;
                    break;
                case GOODS_RED_WINE:
                    $categories['红酒'][] = $goods;
                    break;
                case GOODS_OLD_WINE:
                    $categories['老酒'][] = $goods;
                    break;
                case GOODS_SNACK:
                    $categories['零食'][] = $goods;
                    break;
                case GOODS_WINE:
                    $categories['白酒'][] = $goods;
                    break;
                default:
                    $categories['其他'][] = $goods;
                    break;
            }
        }

        // 呈现
        return view('index/category', [
          'categories' => $categories
        ]);
    }
}
