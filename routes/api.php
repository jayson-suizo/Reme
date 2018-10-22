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
Route::resource('manage/languages','api\manageLanguageController',['except' => ['create','edit']]);

Route::resource('manage/user/subscriptions','api\manageUserSubscriptionController',['except' => ['create','edit']]);

Route::resource('manage/subscriptions','api\manageSubscriptionController',['except' => ['create','edit']]);

Route::resource('manage/professions','api\manageProfessionController',['except' => ['create','edit']]);

Route::resource('manage/questions','api\manageQuestionController',['except' => ['create','edit']]);

Route::resource('manage/answers','api\manageAnswerController',['except' => ['create','edit']]);

Route::resource('manage/user/type','api\manageUserTypeController',['except' => ['create','edit']]);

Route::resource('manage/interventions','api\manageInterventionController',['except' => ['create','edit']]);

Route::resource('manage/music','api\manageMusicController',['except' => ['create','edit']]);

Route::resource('manage/client/subscriptions','api\manageClientSubscriptionController',['except' => ['create','edit']]);

Route::resource('manage/customer/doctors','api\manageCustomerDoctorController',['except' => ['create','edit']]);

Route::post("archive/user",'api\userController@archiveUser');

Route::get('subscription/{code}', 'api\manageClientSubscriptionController@subscription');

Route::resource('manage/client/journal','api\manageJournalController',['except' => ['create','edit']]);

Route::get('manage/music-view/{filename}','api\manageMusicController@viewMusic');

Route::resource('manage/duration','api\manageDurationController',['except' => ['create','edit']]);

Route::resource('manage/group','api\manageGroupController',['except' => ['create','edit']]);


Route::resource('manage/audio','api\manageAudioController',['except' => ['create','edit']]);

Route::get('manage/audio-view/{filename}','api\manageAudioController@viewAudio');



