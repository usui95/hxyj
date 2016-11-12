<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Shop;

class ShopController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 获取列表
        
        if ($request->input('tel')) {
            $shops = Shop::where('tel', $request->get('tel'))->simplePaginate(10);
        } else {
            $shops = Shop::simplePaginate(10);
        }

        return view('admin.shop.index', [
            'shops' => $shops,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.shop.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 过滤 @todo
        $input = $request->all();
        // 校验
        // 校验商户是否已经录入
        $shop = Shop::where('tel', $input['tel'])->where('address', $input['address'])->first();
        if (!empty($shop)) {
            return response()->json(['msg' => '该门店已添加，无需重复添加']);
        }

        // 执行
        $shop = new Shop();
        $shop->tel = $input['tel'];
        $shop->address = $input['address'];
        $shop->name = $input['name'];
        $shop->manager = $input['manager'];
        $shop->logo = $input['logo'];
        $shop->create_time = time();
        $shop->save();
        // 发送
        return response()->json(['msg' => '添加成功', 'data' => [
            'shop' => $shop
        ]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shop = Shop::find($id);
        return response()->json(['data' => [
            'shop' => $shop,
        ]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shop = Shop::find($id);
        return view('admin.shop.edit', [
            'shop' => $shop,
        ]);
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
        // 过滤 @todo
        $input = $request->all();

        // 校验商户是否存在
        $shop = Shop::find($id);
        if (empty($shop)) {
            return response()->json(['msg' => '门店不存在,请核实']);
        }

        // 执行
        $shop->tel = $input['tel'];
        $shop->address = $input['address'];
        $shop->name = $input['name'];
        $shop->manager = $input['manager'];
        $shop->logo = $input['logo'];
        $shop->save();

        // 发送
        return response()->json(['msg' => '编辑成功', 'data' => [
            'shop' => $shop
        ]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 校验商户是否存在
        $shop = Shop::find($id);
        if (empty($shop)) {
            return response()->json(['msg' => '门店不存在,请核实']);
        }

        // 删除
        $shop->delete();

        // 发送
        return response()->json(['msg' => '删除成功']);

    }
}
