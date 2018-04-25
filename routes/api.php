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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/groups', 'GroupController@index');
//Route::get('/group/{id}', 'GroupController@show');
//Route::get('/group/{id}/messages', 'GroupController@get_messages');
//
//
//Route::get('/users', 'UserController@index');
//Route::get('/user/{id}', 'UserController@show');
