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
      ['start_date', '>=', $first_day],
      ['start_date', '<', $end_day]
    ])->orderBy('start_date', 'asc')->get();

    for ($i=0; $i < $first_day->diffInDays($end_day); $i++){
      $schedule_count[$i] = 0;
      $date[$i] = $first_day->copy()->addDay($i)->day;
    }

    $list_time = array();
    $list_item = array();
    $list_location = array();
    $list_description = array();

    foreach ($schedules as $data){
      $schedule_count[$first_day->diffInDays($data->start_date)]++;
      if ($first_day->diffInDays($data->start_date) === $first_day->diffInDays($dt)){
        $list_time[] = $data->start_date->format('H:i');
        $list_item[] = $data->schedule_item;
        $list_location[] = $data->location;
        $list_description[] = $data->description;
      }
    }

    return view('monthly', [
      'timestamp' => $request_date,
      'calendar_date' => $date,
      'schedule_count' => $schedule_count,
      'display_year' => $dt->year,
      'display_month' => $dt->month,
      'display_day' => $dt->day,
      'total_days' => $first_day->diffInDays($end_day),
      'pointday' => $first_day->diffInDays($dt),
      'list_time' => $list_time,
      'list_item' => $list_item,
      'list_location' => $list_location,
      'list_description' => $list_description]);
  }
}
