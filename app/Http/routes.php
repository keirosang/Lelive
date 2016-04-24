<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
//首页路由
Route::group(['middleware' => ['web']], function () {
    Route::get('/','ShowController@index')->name('index');
    Route::get('/u/{id}','ShowController@show');
    Route::get('/about', function () {
        return view('about',[
            'title' => '关于'
        ]);
    });
});

//前台认证路由
Route::group(['middleware' => ['web']], function () {
    Route::auth();
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('register', 'Auth\AuthController@getRegister');
    Route::post('register', 'Auth\AuthController@postRegister');
    Route::get('logout', 'Auth\AuthController@getLogout');
});

//前台管理路由
Route::group(['middleware' => ['web'],'prefix'=>'account'], function () {
    Route::auth();
    Route::get('/','AccountController@getIndex');
    Route::get('create','AccountController@getCreate');
    Route::post('create','AccountController@postCreate');
    Route::get('stop','AccountController@getStop');
    Route::post('stop','AccountController@postStop');
    Route::get('cover','AccountController@getCover');
    Route::post('cover','AccountController@postCover');
    Route::get('username','AccountController@getUsername');
    Route::post('username','AccountController@postUsername');
    Route::get('email','AccountController@getEmail');
    Route::post('email','AccountController@postEmail');
    Route::get('info','AccountController@getInfo');
});

//后台认证路由
Route::group(['middleware' => ['web'],'prefix'=>'admin'], function () {
    Route::auth();
    Route::get('login', 'Admin\AuthController@getLogin');
    Route::post('login', 'Admin\AuthController@postLogin');
    Route::get('register', 'Admin\AuthController@getRegister');
    Route::post('register', 'Admin\AuthController@postRegister');
    Route::get('logout', 'Admin\AuthController@getLogout');
    Route::get('/', 'AdminController@getIndex');
    Route::get('actinfo','AdminController@getActivity');
    Route::get('actinfo/{id}','AdminController@getActivityInfo');
    Route::post('actinfo/{id}','AdminController@postStopActivity');
    Route::get('users','AdminController@getUsers');
    Route::post('users/{id}/block','AdminController@postBlockUser');
    Route::get('blocked','AdminController@getBlockedUsers');
    Route::post('users/{id}/unblock','AdminController@postUnblockUser');
});