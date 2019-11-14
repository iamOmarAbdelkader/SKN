<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix'=>'auth','namespace'=>'Auth'],function(){
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
});

Route::group(['prefix'=>'auth','namespace'=>'Auth','middleware'=>['jwt.refresh']],function($app){
    Route::get('/refresh', 'AuthController@refresh');
});



Route::group(['prefix'=>'auth','namespace'=>'Auth','middleware'=>['jwt.auth']],function($app){
    Route::post('/logout', 'AuthController@logout');
    Route::post('/impersonate', 'AuthController@impersonate');
    Route::get('/user', 'AuthController@user');
});


Route::group(['middleware'=>'jwt.auth'],function(){
    Route::get('/test',function(){
        return response()->json([
            'test'=>'hahahhhahah'
        ]);
    });
    Route::ApiResource('todo','TodoController');
});


