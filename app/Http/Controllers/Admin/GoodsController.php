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
    public function index(Request $request)
    {
        // 读取数据库
        if($request->input('name')){
            $goods = Goods::where('name',$request->get('name'))->simplePaginate(10);
        }else{
            $goods = Goods::simplePaginate(10);
        }
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
        //获取新增数据
        $data = $request->all();
        //验证商品是否存在
        $goods = Goods::where('name', $data['name'])->where('nickname', $data['nickname'])->first();
        if (!empty($goods)) {
            return response()->json(['msg' => '该商品已添加，无需重复添加']);
        }
        //添加
        $goods = new Goods();
        $goods->name = $data['name'];
        $goods->nickname = $data['nickname'];
        $goods->description = $data['description'];
        $goods->price = $data['price'];
        $goods->category = $data['category'];
        $goods->score = $data['score'];
        $goods->comment = $data['comment'];
        $goods->create_time = time();
        $goods->save();
        return response()->json(['msg' => '添加成功', 'data' => [
            'goods' => $goods
        ]]);
    }

    /**
     * Display the specified resource.
     * Display the specified  .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //显示选择商品信息
        $goods = Goods::find($id);
        return response()->json(['data'=>['goods'=>$goods]]);
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
        //
        //编辑指定的内容
        $shop = Goods::find($id);
        return view('admin.shop.edit',['shop'=>$shop]);
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
        //获取要更新的数据
        $data = $request->all();
        $goods = Goods::find($id);
        if(empty($goods)){
            return response()->json(['goods'=>"商品不存在，请核实!"]);
        }
        $goods->name = $data['name'];
        $goods->nickname = $data['nickname'];
        $goods->description = $data['description'];
        $goods->price = $data['price'];
        $goods->category = $data['category'];
        $goods->score = $data['score'];
        $goods->comment = $data['comment'];
        $goods->create_time = time();
        $goods->save();
        return response()->json(['update' => '更新成功', 'data' => ['goods'=>$goods]]);
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
        //shanchu
        $goods = Goods::find($id);
        if(empty($goods)){
            return response()->json(['goods'=>'要删除的商品不存在，请核查！']);
        }
        $goods->delete();

        return response()->json(["del"=>"删除成功"]);
    }
}