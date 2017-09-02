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
	Route::post('verify/update/email', 'api\userController@verifyUpdateEmail');
});
Route::post('login', 'api\userController@login');
Route::post('change/password', 'api\userController@changePassword');
Route::post('confirm/change/password', 'api\userController@confirmChangePassword');

Route::post('register', 'api\userController@register');
Route::post('verify', 'api\userController@verify');

Route::resource('manage/users','api\manageUserController',['except' => ['create','edit']]);
Route::resource('manage/activities','api\manageActivityController',['except' => ['create','edit']]);
Route::resource('manage/user/languages','api\manageUserLanguageController',['except' => ['create','edit']]);
