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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware' => 'auth:api'], function(){
	Route::get('user', 'api\userController@details');
	Route::get('logout', 'api\userController@logout');
	Route::post('update', 'api\userController@update');
	Route::post('update/email', 'api\userController@updateEmail');
});
Route::post('login', 'api\userController@login');
Route::post('register', 'api\userController@register');
Route::post('verify', 'api\userController@verify');
