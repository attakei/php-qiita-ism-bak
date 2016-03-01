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

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('top.index');
    });

    Route::post('/auth/google', ['as' => 'auth_oauth_google', 'uses' => 'Auth\AuthController@redirectToProvider']);
    Route::get('/auth/google/callback', ['as' => 'auth_oauth_callback', 'uses' => 'Auth\AuthController@callbackFromProvider']);
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/dashboard', 'HomeController@dashboard');
});
