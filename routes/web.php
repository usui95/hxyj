<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


/************** 通用服务 **************/
Route::resource('photos', 'PhotoController');

/************** 前台路由 **************/
Route::get('/', 'IndexController@home')->name('home'); // 首页
Route::get('/ajaxShops', 'IndexController@ajaxShops'); // 首页
Route::get('/c', 'IndexController@category')->name('category'); // 分类
Route::resource('goods', 'GoodsController'); // 商品详情页

/************** 后台路由 **************/
Route::get('/admin/login', 'Admin\SiteController@login'); // 后台登录页面
Route::post('/admin/doLogin', 'Admin\SiteController@doLogin'); // 后台登录页面
Route::get('/admin', 'Admin\IndexController@index')->name('admin'); // 后台首页
Route::resource('/admin/shops', 'Admin\ShopController');
Route::resource('/admin/goods', 'Admin\GoodsController');

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('foo', function () {
//    return 'Hello World';
//});

//Route::any('user/{id}', 'UserController@show');

//Route::get('user/{id}', function ($id) {
//    return view('welcome', [
//        'id' => '123'
//    ]);
//});

//Route::get('user/{id}', function ($id) {
//    return "user{$id}";
//});

//Route::get('posts/{postId}/comments/{commentId}', function ($postId, $commentId) {
//    return "post id is {$postId} <br /> comment id is {$commentId}";
//})->name('hehe');

//Route::resource('photos', 'PhotoController');

// 首页
Route::get('/', 'IndexController@home')->name('home');

// 分类
Route::get('/c', 'IndexController@category')->name('category');

// 商品详情页
Route::resource('goods', 'GoodsController');

/* 通用服务 */
Route::resource('photos', 'PhotoController');

/*   后台路由   */

// 后台首页
Route::get('/admin', 'Admin\IndexController@index')->name('admin');
Route::resource('/admin/shops', 'Admin\ShopController');
Route::resource('/admin/goods', 'Admin\GoodsController');

























