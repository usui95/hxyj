<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取自己的列表 @todo
        $photos = Photo::simplePaginate(10);

        return view('photo.index', $photos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('photo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 过滤
//        if (!$request->has('photo')) {
//            return response()->json(['msg' => '请指定图片字段']);
//        }
        if (!Photo::isSizeOkay($request->file('photo'))) {
            return response()->json(['msg' => '图片最大不能超过5M']);
        }
        if (!Photo::isExtensionOkay($request->file('photo'))) {
            return response()->json(['msg' => '图片只支持jpeg/jpg/png格式']);
        }


        // 执行
        // 存储
        $path = $request->file('photo')->storeAs('photos', Photo::filename($request->file('photo')));

        // DB
        $info = getimagesize($request->file('photo')->getRealPath());
        $photo = new Photo();
        $photo->size = $request->file('photo')->getSize();
        $photo->height = $info[0];
        $photo->width = $info[1];
        $photo->mime = $request->file('photo')->getMimeType();
        $photo->save();

        // 提示
        return response()->json([
            'msg' => '上传成功',
            'data' => [
                'path' => $path,
                'url' => asset("storage/{$path}"),
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
