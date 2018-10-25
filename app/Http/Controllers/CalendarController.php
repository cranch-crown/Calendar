<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
  /*
  public function __construct()
  {
    $this->middleware('auth');
  }
  */

  public function index() {
    if(Auth::check()) {
      /*$schedules = Schedule::orderBy('schedule_time', 'asc')->get();
      return view('daily', ['schedules' => $schedules]);*/
      $dt = Carbon::now();
      /*viewの選択 ユーザー設定反映のタイミング*/
      return redirect('/month/'.$dt->timestamp);
    }
    return view('welcome');
  }

  public function register() {
    return view('auth.register');
  }
  public function login() {
    return view('auth.login');
  }
  public function logout() {
    Auth::logout();
    return redirect('/');
  }

  public function welcome() {
    return view('welcome');
  }

  public function developMode() {
    return view('devView');
  }

  public function make_schedule() {
    return view('make_schedule');
  }

  public function save_schedule(Request $request) {
    /*バリデーション書くよ regex:～ は正規表現　おべんきょ後に書く*/
    $validator = Validator::make($request->all(), [
      'schedule_item' => 'max:300',
      'schedule_time' => 'required',
      'schedule_endtime' => 'required',
      'location' => 'max:300',
      'description' => 'max:300',
    ]);

    if ($validator->fails()) {
      return redirect('/')->withInput()->withErrors($validator);
    }
    /*オートコレクト（入力された情報を忖度する）機能つけたい。特に日付に関して*/

    $schedules = new Schedule;
    $schedules->schedule_item = $request->schedule_item;
    $schedules->schedule_time = $request->schedule_time;
    $schedules->schedule_endtime = $request->schedule_endtime;
    $schedules->location = $request->location;
    $schedules->description = $request->description;
    /*$schedules->user_name = "kaihatsu_data";*/
    $schedules->save();
    return redirect('/');
  }

}
/*
class SetCalendarData
{
  public mode = 0;

  public function month(&$array, $dt) {
    /*日付取得処理*/
/*
    $startCalendar = new Carbon(getFirstDay($dt->startOfMonth()->copy()));
    $endCalendar = new Carbon(getLastDay($dt->endOfMonth()->copy()));

    for(i = 0; i < 42; i++){
      $array[i] = $startCalendar->addDay(i);
      i++;
    }
    return i;
  }

  private function getFirstDay($dt) {
    while($dt->dayOfWeek != this->mode) {
      $dt = $dt->subDay();
    }
    return $dt;
  }

  private function getLastDay($dt) {
    while($dt->dayOfWeek != this->mode){
      $dt = $dt->addDay();
    }
    return $dt;
  }
}
*/
