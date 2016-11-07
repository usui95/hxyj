<?php

namespace App\Http\Controllers\Admin;
//header("Content-Type:application/json;charset=utf-8");
header("Content-type:application/json;charset=utf-8");

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
    public function index()
    {
        // 获取列表
        $shops = Shop::all();
         // dd($shops);
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
        return response()->json(['msg' => '添加成功', 'data' => $shop]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $id = $_GET['id'];
        $shop =  Shop::find($id);
        echo json_encode($shop);
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
        $data = $request->all();
        $shops = Shop::find($id);
       // $shops = new Shop();
        $shops->name = $data['name'];
        $shops->manager = $data['manager'];
        $shops->address = $data['address'];
        $shops->logo = $data['logo'];
        $shops->tel = $data['tel'];
        if($shops->save){
            echo json_encode($shops);
        }
        //发送
        return response()->json(['up'=>'更新成功','data'=>$shops]);
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
