<?php

namespace App\Http\Controllers\Admin;

use App\Models\Goods;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //商品列表
    public function index()
    {
        // 读取数据库
        $goods = Goods::all();
       return view('admin.goods.index',['goods'=>$goods]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //新增商品页
        return view('admin.goods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //保存方法
    public function store(Request $request)
    {
        //保存新增数据
        $data = $request->all();
        //验证商品是否存在
        $goods = Goods::where('id',$data['id'])->first();
        if(isset($goods)){
            echo response()->json( '商品已存在，无需填添加');
        }
        $goods = new Goods();
        $goods->name = $data['name'];
        $goods->nickname = $data['nickname'];
        $goods->description = $data['description'];
        $goods->price = $data['price'];
        $goods->category = $data['category'];
        $goods->score = $data['score'];
        $goods->comment = $data['comment'];
        if($goods->save()){
            echo resopen()->json('添加商品成功'.$goods);
        }
    }

    /**
     * Display the specified  .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //显示选择商品信息

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //修改信息页
    public function edit($id)
    {
        //编辑指定的内容
        $shop = Goods::find($id);
       // return view('admin.shop.update',["shop"=>$shop]);
        echo json_encode($shop);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //更新方法
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $goods = Goods::find($id);
        $goods->name = $data['name'];
        $goods->nickname = $data['nickname'];
        $goods->description = $data['description'];
        $goods->price = $data['price'];
        $goods->category = $data['category'];
        $goods->score = $data['score'];
        $goods->comment = $data['comment'];
        $goods->save();
       // echo json_encode($goods);
        return response()->json(['update' => '更新成功', 'data' => $goods]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //删除商品
    public function destroy($id)
    {
        $goods = Goods::find($id);
        $goods->delete();
        return response()->json(["del"=>"删除成功"]);
    }
}
