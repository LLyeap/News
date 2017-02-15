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
        Route::resource('admin_role', 'AdminRoleController');
        Route::resource('admin_role_info', 'AdminRoleController@getAdminRoleInfo');
        Route::resource('admin_user', 'AdminUserController');
        Route::resource('admin_user_info', 'AdminUserController@getAdminUserInfo');
        Route::resource('content', 'ContentController');
        Route::resource('content_info', 'ContentController@getContentInfo');
        Route::resource('upload_image', 'ContentController@uploadImage');
        Route::resource('category', 'CategoryController');
        Route::resource('category_info', 'CategoryController@getCategoryInfo');
        Route::resource('category_all', 'CategoryController@getCategoryAll');
        Route::resource('nav', 'NavController');
        Route::resource('nav_info', 'NavController@getNavInfo');
        Route::resource('nav_all', 'NavController@getNavAll');
        Route::resource('link', 'LinkController');
        Route::resource('link_info', 'LinkController@getLinkInfo');
        Route::get('copyright', function (){
            return view('admin.site.copyright');
        });
        Route::get('stop', function (){
            return view('admin.site.stop');
        });
    });
});


Route::group(['domain' => 'www.mysite.com', 'namespace' => 'home'], function () {
    Route::controller('main', 'MainController');
});


