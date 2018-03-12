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

Route::get('/', 'CalendarController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
ログイン直後
一月前のリクエスト
一月後のリクエスト
表示変更のリクエスト
日付表示のリクエスト
予定追加のリクエスト
予定削除
予定編集
*/
