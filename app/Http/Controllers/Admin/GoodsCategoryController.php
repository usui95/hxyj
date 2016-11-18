<?php

namespace App\Http\Controllers\Admin;

use App\Models\GoodsCategory;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GoodsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $goodsCategory = GoodsCategory::all();
        return view('admin.goods_category.index',['goodsCategory'=>$goodsCategory]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.goods_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 过滤 @todo
        $input = $request->all();

        // 校验
        // 类别下的名称是否存在
        $goodsCategory = GoodsCategory::where('category_id', $input['category_id'])->where('name', $input['name'])->first();
        // select * from `goods_categories` where `category_id` = ? and `name` = ? and `goods_categories`.`deleted_at` is null
        if (!empty($goodsCategory)) {
            return response()->json(['msg' => '已经存在,无需重复录入']);
        }

        // 执行
        $goodsCategory = new GoodsCategory();
        $goodsCategory->category_id = $input['category_id'];
        $goodsCategory->name = $input['name'];
        $goodsCategory->logo = $input['logo'];
        $goodsCategory->url = $input['url'];
        $goodsCategory->save();

        // 发送
        return response()->json(['msg' => '添加成功', 'data' => ['goodsCategory' => $goodsCategory]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $goodsCategory = GoodsCategory::find($id);
        if (empty($goodsCategory)) {
            return response()->json(['msg' => '商品分类不存在'], 403);
        }
        return response()->json(['data' => ['goodsCategory' => $goodsCategory]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $goodsCategory = GoodsCategory::find($id);
        if (empty($goodsCategory)) {
            return response()->json(['msg' => '商品分类不存在'], 403);
        }
        return view('admin.goods_category.update', [
            'goodsCategory' => $goodsCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 过滤 @todo
        $input = $request->all();

        // 校验
        $goodsCategory = GoodsCategory::find($id);
        if (empty($goodsCategory)) {
            return response()->json(['msg' => '商品分类不存在'], 403);
        }
        if ($goodsCategory->name !== $input['name']) {
            $oldGoodsCategory = GoodsCategory::where('category_id', $input['category_id'])->where('name', $input['name'])->first();
            if (!empty($oldGoodsCategory)) {
                return response()->json(['msg' => '该名称已经存在,你不能录入']);
            }
        }

        // 执行
        $goodsCategory->category_id = $input['category_id'];
        $goodsCategory->name = $input['name'];
        $goodsCategory->logo = $input['logo'];
        $goodsCategory->url = $input['url'];
        $goodsCategory->save();

        // 发送
        return response()->json(['msg' => '编辑成功', 'data' => ['goodsCategory' => $goodsCategory]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $goodsCategory = GoodsCategory::find($id);
        if (empty($goodsCategory)) {
            return response()->json(['msg' => '商品分类不存在'], 403);
        }
        $goodsCategory->delete();
        return response()->json(['msg' => '删除成功']);
    }
}
