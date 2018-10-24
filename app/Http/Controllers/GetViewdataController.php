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
  private function getEndDay($dt){
    $dt = $dt->endOfMonth();
    while($dt->dayOfWeek != 0)
      $dt = $dt->addDay();
    return $dt;
  }

  public function month($request_date){
    $dt = Carbon::createFromTimestamp($request_date);
    $first_day = $this->getStartDay($dt->copy());
    $end_day = $this->getEndDay($dt->copy());

    $schedules = Schedule::where([
      ['schedule_time', '>=', $first_day],
      ['schedule_time', '<', $end_day]
    ])->orderBy('schedule_time', 'asc')->get();

    for($i=0; $i < $first_day->diffInDays($end_day); $i++){
      $schedule_count[$i] = 0;
      $date[$i] = $first_day->copy()->addDay($i)->day;
    }

    foreach ($schedules as $day){
      $schedule_count[$first_day->diffInDays($day->schedule_time)]++;
    }

    return view('monthly', [
      'schedules' => $schedules,
      'date' => $date,
      'schedule_count' => $schedule_count,
      'display_year' => $dt->year,
      'display_month' => $dt->month,
      'display_day' => $dt->day,
      'calendar_first_day' => $first_day,
      'total_days' => $first_day->diffInDays($end_day),]);
  }
}
