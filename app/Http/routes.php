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

Route::group(['domain' => 'admin.mysite.com', 'namespace' => 'admin'], function () {
    Route::get('/code/captcha/{tmp}', 'LoginController@captcha');
    Route::resource('/login', 'LoginController');
    Route::resource('doLogin', 'LoginController@doLogin');
    Route::resource('/logout', 'LoginController@logout');

    Route::group(['middleware' => 'Admin.admin'], function () {
        Route::get('/', function () {
            return view('admin.index.index');
        });
        Route::resource('admin_user', 'AdminUserController');
        Route::resource('admin_user_info', 'AdminUserController@getAdminUserInfo');
        Route::resource('content', 'ContentController');
        Route::resource('upload_image', 'ContentController@uploadImage');
    });
});


Route::group(['domain' => 'www.mysite.com', 'namespace' => 'home'], function () {
    Route::get('/', function () {
        return view('home.index.index');
    });
    Route::get('/list', function () {
        return view('home.list.index');
    });
    Route::get('/detail', function () {
        return view('home.detail.index');
    });
});


