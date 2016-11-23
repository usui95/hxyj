<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Shop;
use Illuminate\Http\Request;

use App\Http\Requests;

class ShopsController extends Controller
{
    public function index(){
        return view('index');
    }
    public function show(Request $request)
    {
        $data = $request->all();
       // $id = $data['id'];
        dd(Shop::all());
//              $shop = Shop::find($id);
//        $goods = Goods::all();
//        return view('index', [
//            'shop' => $shop,
//            'goods' => $goods,
//        ]);


    }

}