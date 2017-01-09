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

Route::group(['prefix' => 'backend', 'namespace'  => 'admin'], function () {
    Route::get('/code/captcha/{tmp}', 'LoginController@captcha');
    Route::resource('/login', 'LoginController');
    Route::resource('/logout', 'LoginController@logout');
});

Route::get('/', function () {
    return view('welcome');
});

