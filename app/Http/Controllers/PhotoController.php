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
        dd(Photo::all());
        $photos = Photo::simplePaginate(10);

        return view('admin.photo.index', $photos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.photo.create');
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
        $photo = Photo::find($id);
        if (empty($photo)) {
            return response()->json(['msg' => '图片不存在'], 403);
        }
        return response()->json(['data' => ['photo' => $photo]]);
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
        $photo = Photo::find($id);
        if (empty($photo)) {
            return response()->json(['msg' => '图片不存在']);
        }
        return response()->json(['data' => ['photo' => $photo]]);
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


        $path = $request->file('photo')->storeAs('photos', Photo::filename($request->file('photo')));

        // DB
        $info = getimagesize($request->file('photo')->getRealPath());
        $photo = new Photo();
        $photo->size = $request->file('photo')->getSize();
        $photo->height = $info[0];
        $photo->width = $info[1];
        $photo->mime = $request->file('photo')->getMimeType();
        $photo->save();

        return response()->json([
            'msg' => '上传成功',
            'data' => [
                'path' => $path,
                'url' => asset("storage/{$path}"),
            ]
        ]);

        //更新
        if (!Photo::isSizeOkay($request->file('photo'))) {
            return response()->json(['msg' => '图片最大不能超过5M']);
        }
        if (!Photo::isExtensionOkay($request->file('photo'))) {
            return response()->json(['msg' => '图片只支持jpeg/jpg/png格式']);
        }
        $data = $request->all();


        $photo = Photo::find($id);

        $photo = new Photo();
        $photo->size = $data['size'];
        $photo->size = $data['size'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除操作
        $photo = Photo::find($id);
        if (empty($photo)) {
            return response()->json(['msg' => '要删除的图片不存在!']);
        }
        //执行删除
        $photo->delete();
        //推送
        return response()->json(['msg' => '删除成功']);
    }
}
