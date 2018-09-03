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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


Route::get('/','HomeController@index');

// ==============================
//     ユーザー関連のルート
// ==============================
Route::get('/users/sign_up','UsersController@create');
Route::post('/users/sign_up','UsersController@store');
Route::get('users/login','UsersController@getAuth');
Route::post('users/login','UsersController@postAuth');
Route::get('users/logout','UsersController@getLogout')->middleware('auth');
Route::get('user/edit','UsersController@edit')->middleware('auth');
Route::post('user/edit','UsersController@update')->middleware('auth');


// ==============================
//     教材関連のルート
// ==============================
Route::get('/contents/create','ContentsController@create')->middleware('auth');
Route::post('/contents/create','ContentsController@store')->middleware('auth');

Route::match(['GET','POST'],'/contents/confirm','ContentsController@confirm')->middleware('auth');

Route::post('/contents/store','ContentsController@store')->middleware('auth');
Route::get('/contents/cancel','ContentsController@cancel')->middleware('auth');

Route::get('/content/show','ContentsController@show')->middleware('auth');
Route::post('/content/download','ContentsController@download')->middleware('auth');
