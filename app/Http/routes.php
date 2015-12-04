<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


//以下是API路由
//认证
Route::post('api/auth','API\AuthController@login');

//注销
Route::get('api/logout','API\AuthController@logout');

//注册
Route::post('api/register','API\AuthController@Register');

//获取热门帖子列表
Route::get('api/hotPosts','API\PostController@index');

//帖子的获取，新建，删除
Route::resource('api/post','API\PostController');

//获取帖子的楼和评论
Route::get('api/floorDetail','API\PostController@floorsAndComments');

//回复帖子（新建楼）
Route::post('api/replyPost','API\FloorController@store');

//删除楼
Route::delete('api/floor/{id}','API\FloorController@destory');

//评论楼
Route::post('api/comFloor','API\CommentController@store');

//删除评论
Route::delete('api/comment/{id}','API\CommentController@destory');

//创建贴吧
Route::post('api/ba','API\BaController@store');

//用户关注贴吧
Route::post('api/user/ba','API\FollowController@store');

//获取用户关注的贴吧列表
Route::get('api/user/ba','API\FollowController@index');
