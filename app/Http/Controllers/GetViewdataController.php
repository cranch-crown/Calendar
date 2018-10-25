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
      $date[$i] = $first_day->copy()->addDay($i)->day == 1?
      $first_day->copy()->addDay($i)->format('m月d日'):
      $first_day->copy()->addDay($i)->day;
    }

    $list = array();
    foreach ($schedules as $data){
      $schedule_count[Carbon::parse($data->start_date)->diffInDays($first_day)]++;
      if (Carbon::parse($data->start_date)->diffInDays($first_day) == $first_day->diffInDays($dt)){
        $list['time'][] = Carbon::parse($data->start_date)->format('H:i');
        $list['item'][] = $data->schedule_item;
        $list['location'][] = $data->location;
        $list['description'][] = $data->description;
      }
    }
    session(['select_view' => 'month', 'timestamp' => $request_date]);

    return view('monthly', [
      'request_dt' => $request_date,
      'calendar_date' => $date,
      'schedule_count' => $schedule_count,
      'total_days' => $first_day->diffInDays($end_day),
      'pointday' => $first_day->diffInDays($dt),
      'list' => $list ]);
  }
}
