<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class GetViewdataController extends Controller
{
  private function getStartDay($dt){
    $dt = $dt->startOfMonth();
    while($dt->dayOfWeek != 0)
      $dt = $dt->subDay();
    return $dt;
  }

  public function month($request_date){
    $dt = Carbon::createFromTimestamp($request_date);
    $first_day = $this->getStartDay($dt->copy());
    $schedules = Schedule::where([
      ['schedule_time', '>=', $first_day],
      ['schedule_time', '<', $first_day->copy()->addDay(42)]
    ])->orderBy('schedule_time', 'asc')->get();
    return view('monthly',[
      'schedules' => $schedules,
      'display_month' => $dt->month,
      'calendar_first_day' => $first_day]);
  }
}
