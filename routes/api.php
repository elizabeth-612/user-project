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


/**
 * API Routes - Without Header Authentication
 */
Route::group(["namespace" => "Api", "middleware" => ["api"]], function () {

      // list
      Route::post('userList', 'ApiController@userList')->name('userList');
});
