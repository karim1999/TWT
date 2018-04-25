<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->middleware('guest');


Route::group(['middleware' => ['isVerified']], function () {

});

Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/chat', 'ChatController@index')->name('home');
    Route::get('/chat/{any}', 'ChatController@index')->where('any', '.*');

    Route::get('/groups', 'userController@get_groups');
    Route::get('/group/{id}', 'GroupController@show');
    Route::get('/group/{id}/messages', 'GroupController@get_messages');
    Route::post('/group/{id}/send', 'MessageController@sendToGroup');

    Route::get('/current', 'UserController@getCurrentUser');
    Route::get('/users', 'UserController@index');
    Route::get('/user/{id}', 'UserController@show');
    Route::get('/user/{id}/messages', 'UserController@get_messages');
    Route::post('/user/{id}/send', 'MessageController@sendToUser');
    Route::get('/user/picture/{id}', 'UserController@getUserPicture');
});
Auth::routes();
