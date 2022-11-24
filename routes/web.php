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


Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => ['web']], function () {

    Route::get('/', 'UserController@index')->name('index');
    Route::get('user/edit/{id}',  'UserController@edit')->name('user.edit');
    Route::post('user/update/{id}',  'UserController@update')->name('user.update');
    Route::get('user/export', 'UserController@userExport')->name('user.export');
    Route::get('fetch/user', 'UserController@fetchUser')->name('user.fetch');
});
