<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use Validator;
use Carbon\Carbon;

class CalendarController extends Controller
{
  public function index() {
    $today = new Carbon();
    $datas = new SetCalendarData();

    //セッションデータに今月を格納
    session(['showDate' => '$today']);

    $calendarDays = array();

    $weekdays = $datas->month($calendarDays, $today->copy());

    return view('monthly', compact('$calendarDays', '$weekdays'));
  }
}

class SetCalendarData
{
  public mode = 0;

  public function month(&$array, $dt) {
    /*日付取得処理*/
    $startCalendar = new Carbon(getFirstDay($dt->startOfMonth()->copy()));
    $endCalendar = new Carbon(getLastDay($dt->endOfMonth()->copy()));

    $i = 0;
    while($startCalendar->addDay(i) != $endCalendar) {
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
