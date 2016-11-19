<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Slide;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //商品列表
    public function index(Request $request)
    {
        //读取数据库并设置分页
       // dd(Slide::all());
        if ($request->input('src')) {
            $slide = Slide::where('src', $request->get('src'))->simplePaginate(10);
        } else {
            $slide = Slide::simplePaginate(10);
        }
        return view('admin.slide.index', ['slide' => $slide]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //新增
        return view('admin.slide.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    //保存方法
    public function store(Request $request)
    {
        //获取新增数据
        $data = $request->all();
        //验证图片是否存在
        $slide = Slide::where('id', $data['id'])->first();
        if (!empty($slide)) {
            return response()->json(['msg' => '该图片已添加，无需重复添加']);
        }
        //添加
        $slide = new Slide();
        $slide->url = $data['url'];
//        $slide->name = $data['name'];
        $slide->src = $data['src'];
        $slide->create_time = time();
        $slide->save();
        return response()->json(['msg' => '添加成功', 'data' => ['slide' => $slide]]);
    }

    /**
     * Display the specified resource.
     * Display the specified  .
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //显示图片信息
        $slide = Slide::find($id);
        if (empty($slide)) {
            return response()->json(['msg' => '图片不存在！', 403]);
        }
        return response()->json(['data' => ['slide' => $slide]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    //修改信息页
    public function edit($id)
    {
        //编辑指定的内容
        $slide = Slide::find($id);
        if (empty($slide)) {
            return response()->json(['msg' => '不存在', 403]);
        }
        return response()->json(['data' => ['slide' => $slide]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    //更新方法
    public function update(Request $request, $id)
    {
        //获取要更新的数据
        $data = $request->all();
        $slide = Slide::find($id);
        if (empty($slide)) {
            return response()->json(['msg' => "图片不存在，请核实!"]);
        }
        $name = Slide::all(['src'])->toArray();
        if (in_array(['src' => $data['src']], $name)) {
            if ($data['src'] == $slide['src']) {
                $slide->url = $data['url'];
              //  $slide->name = $data['name'];
                $slide->src = $data['src'];
                $slide->create_time = time();
                $slide->save();
                return response()->json(['msg' => '更新成功', 'data' => ['slide' => $slide]]);
            } else {
                return response()->json(['msg' => '图片重复，请重新添加']);
            }
        } else {
            $slide->url = $data['url'];
        //    $slide->name = $data['name'];
            $slide->src = $data['src'];
            $slide->create_time = time();
            $slide->save();
            return response()->json(['msg' => '更新成功', 'data' => ['slide' => $slide]]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    //删除图片
    public function destroy($id)
    {
        //删除
        $slide = Slide::find($id);
        if (empty($slide)) {
            return response()->json(['msg' => '要删除的图片不存在，请核查！']);
        }
        $slide->delete();

        return response()->json(["msg" => "删除成功"]);
    }

}