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


Route::get('/','HomeController@index');

// ==============================
//     ユーザー関連のルート
// ==============================
Route::get('/users/sign_up','UsersController@create');
Route::post('/users/sign_up','UsersController@store');
Route::get('/users/login','UsersController@getAuth');
Route::post('/users/login','UsersController@postAuth');
Route::post('/users/register/pre_check','UsersController@store')->name('register');
//【SNSログイン】Facebook認証
Route::get('/users/login/facebook', 'FacebookController@redirectToFacebook');
Route::get('/users/login/callback','FacebookController@handleProviderCallback');

//メールアドレス変更
Route::get('/user/email/edit','UsersController@editEmail');
Route::post('/user/email/edit','UsersController@updateEmail');

//パスワード変更
Route::get('/user/password/edit','UsersController@editPassword');
Route::post('/user/password/edit','UsersController@updatePassword
');


//ユーザーのメール確認
Route::get('/register/verify/{token}','UsersController@showForm');

Route::get('/users/logout','UsersController@getLogout')->middleware('auth');
Route::get('/user/edit','UsersController@edit')->middleware('auth');
Route::post('/user/edit','UsersController@update')->middleware('auth');




// ==============================
//     教材関連のルート
// ==============================
Route::get('/contents/create','ContentsController@create')->middleware('auth');
Route::post('/contents/create','ContentsController@store')->middleware('auth');

Route::get('/contents/confirm','ContentsController@confirm')->middleware('auth');
Route::post('/contents/confirm','ContentsController@postConfirm')->middleware('auth');

Route::post('/contents/store','ContentsController@store')->middleware('auth');
Route::get('/contents/cancel','ContentsController@cancel')->middleware('auth');

Route::get('/content/show','ContentsController@show');
Route::post('/content/download','ContentsController@download')->middleware('auth');

//コンテンツイメージ表示パス
Route::get('/content/content_image/{content_image}','ContentsController@downloadImage');



// ==============================
//     【API】Stripe決済機能
// ==============================
Route::post('/charge','CheckoutController@charge')->name('charge');
