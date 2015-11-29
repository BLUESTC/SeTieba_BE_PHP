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

Route::post('api/auth','API\AuthController@login');
Route::get('api/logout','API\AuthController@logout');
Route::post('api/register','API\AuthController@Register');

Route::get('api/hotPosts','API\PostController@index');
Route::resource('/api/post','API\PostController');
Route::get('api/floorDetail','API\PostController@floorsAndComments');
Route::post('/api/replyPost','API\FloorController@store');
Route::post('/api/comFloor','API\CommentController@store');
