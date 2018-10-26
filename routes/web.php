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

/*トップページアクセス*/
Route::get('/', 'CalendarController@index');

Route::post('/make-schedule', 'CalendarController@make_schedule');

Route::post('/save-schedule', 'CalendarController@save_schedule');

Route::get('/register', 'CalendarController@register');
Route::get('/login', 'CalendarController@login');
Route::get('/logout', 'CalendarController@logout');

Route::get('/welcome', 'CalendarController@welcome');
Route::get('/dev', 'CalendarController@developMode');


/*Route::post('/year');*/
Route::get('/month/{request_date}', 'GetViewdataController@month');
/*Route::post('/week');*/
/*Route::post('/day');*/
/*Route::post('/list');*/

Route::get('/makeschedule/{view}/{dt}', 'AddScheduleController@newschedule');
Route::post('/schedule/save', 'AddScheduleController@save');
Route::post('/schedule/edit', 'AddScheduleController@edit');
Route::post('/schedule/update', 'AddScheduleController@update');
Route::get('/returnview', 'AddScheduleController@returnview');
Route::delete('/delete', 'AddScheduleController@delete');


Route::get('/back_month', 'DateMoveController@submonth');
Route::get('/advance_month', 'DateMoveController@addmonth');
Route::get('/request/month-today', 'DateMoveController@today');

Route::get('/dayrequest/{i}', 'DateMoveController@dayrequest');


Auth::routes();

/*Route::get('/home', 'HomeController@index')->name('home');*/

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
