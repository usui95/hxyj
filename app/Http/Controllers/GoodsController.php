<?php

namespace App\Http\Controllers;

use App\Models\GoodsScore;
use App\Models\Goods;

use Illuminate\Http\Request;
use App\Http\Requests;

class GoodsController extends Controller
{

    public function category()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 获取商品
        $goods = Goods::find($id);
        $goodsScore = Goods::find($id)->goodsScore;
        $goodsDetail = Goods::find($id)->goodsDetail;

        return view('goods.show', [
            'goods' => $goods,
            'goods_relate' => [],
            'goods_summary' => [], // 概述
            'goodsDetail' => $goodsDetail, // 参数之含量
            'goodsScore' => $goodsScore, // 参数之分数
            'goods_thumb' => [], // 略缩图
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
