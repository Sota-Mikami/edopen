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
Route::post('/user/password/edit','UsersController@updatePassword');


//ユーザーのメール確認
Route::get('/register/verify/{token}','UsersController@showForm');

//ユーザーログイン・新規登録
Route::get('/users/logout','UsersController@getLogout')->middleware('auth');
Route::get('/user/edit','UsersController@edit')->middleware('auth');
Route::post('/user/edit','UsersController@update')->middleware('auth');

//ユーザー一覧機能
Route::get('/users/index', 'UsersController@showAll');
Route::get('/users/show', 'UsersController@show');

//フォロー・アンフォロー
Route::get('/user/follow','UsersController@follow');
Route::get('/user/unfollow','UsersController@unfollow');


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

Route::get('/content/edit','ContentsController@edit')->middleware('auth');
Route::post('/content/edit','ContentsController@update')->middleware('auth');
Route::get('/content/delete','ContentsController@destroy')->middleware('auth');


//コンテンツ画像削除
Route::get('/content/content_image/delete','ContentsController@delete_contents_img')->middleware('auth');

//コンテンツダウンロード
Route::get('/content/download','ContentsController@downloadContent');

// ==============================
//     教育コンテンツカテゴリーのルート
// ==============================

Route::get('/categories', 'CategoriesController@index');
Route::post('/categories/create','CategoriesController@store');
Route::post('/categories/update','CategoriesController@update');
Route::get('/categories/delete','CategoriesController@destroy');


// ==============================
//     【API】Stripe決済機能
// ==============================
Route::post('/charge','CheckoutController@charge')->name('charge');
