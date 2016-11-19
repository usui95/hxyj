<?php

namespace App\Http\Controllers\Admin;

use App\Models\NinePatch;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NinePatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //主页
//        dd(NinePatch::all());
        if ($request->input('name')) {
            $ninePatch = NinePatch::where('name', $request->get('name'))->simplePaginate(10);
        } else {
            $ninePatch = NinePatch::simplePaginate(10);
        }
       return view('admin.nine_patch.index', ['ninePatch' => $ninePatch]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //新增页面
        return view('admin.nine_patch.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //保存新增数据
        $data = $request->all();
        //判断
        $ninePatch = NinePatch::where('name', $data['name'])->first();
        if (!empty($ninePatch)) {
            return response()->jspn(['msg' => '已存在，无需重复添加']);
        }
        $ninePatch = new NinePatch();
        $ninePatch->name = $data['name'];
        $ninePatch->thumb = $data['thumb'];
        $ninePatch->url = $data['url'];
        $ninePatch->weight = $data['weight'];
        $ninePatch->create_time = time();
        //保存
        $ninePatch->save();
        //推送
        return response()->json(['msg' => '保存成功', 'data' => ['nicePatch' => $ninePatch]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ninePatch = NinePatch::find($id);
        if (empty($ninePatch)) {
            return response()->json(['msg' => '九宫格不存在！'], 403);
        }
        return response()->json(['data' => ['ninePatch' => $ninePatch]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //更新
        $ninePatch = NinePatch::find($id);
        if (empty($ninePatch)) {
            return response()->json(['msg' => '九宫格不存在！'], 403);
        }
        return response()->json(['data' => ['ninePatch' => $ninePatch]]);
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
        //保存更新的数据
        $data = $request->all();
        //判断
        $nicePatch = NinePatch::find($id);
        if (empty($nicePatch)) {
            return response()->json(['msg' => '您要更新的不存在，请核实！']);
        }
        //判断更新后名字是否有相同
        $name = NinePatch::all(['name'])->toArray();
        if (in_array(['name' => $data['name']], $name)) {
            if ($data['name'] == $nicePatch['name']) {
                $nicePatch->thumb = $data['thumb'];
                $nicePatch->url = $data['url'];
                $nicePatch->weight = $data['weight'];
                $nicePatch->create_time = time();
                //保存
                $nicePatch->save();
                //推送
                return response()->json(['msg' => '更新成功', 'data' => ['ninePatch' => $nicePatch]]);
            } else {
                return response()->json(['msg' => '名字重复，请重新命名']);
            }
        } else {
            $nicePatch->name = $data['name'];
            $nicePatch->thumb = $data['thumb'];
            $nicePatch->url = $data['url'];
            $nicePatch->weight = $data['weight'];
            $nicePatch->create_time = time();
            //保存
            $nicePatch->save();
            //推送
            return response()->json(['msg' => '更新成功', 'data' => ['ninePatch' => $nicePatch]]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除
        $ninePatch = NinePatch::find($id);
        //判断
        if (empty($ninePatch)) {
            return response()->json(['msg' => '不存在，请重新核实']);
        }
        $ninePatch->delete();
        //推送
        return response()->json(['msg' => '删除成功']);
    }
}
