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
    $dt = [
      "request" => Carbon::createFromTimestamp($request_date),
      "first_day" => $this->getStartDay(Carbon::createFromTimestamp($request_date)->copy()),
      "end_day" => $this->getEndDay(Carbon::createFromTimestamp($request_date)->copy()) ];
/*    $dt['requst'] = Carbon::createFromTimestamp($request_date);
    $dt["first_day"] = $this->getStartDay($dt['request']->copy());
    $dt["end_day"] = $this->getEndDay($dt['request']->copy());*/

    $schedules = Schedule::where([
      ['start_date', '>=', $dt["first_day"] ],
      ['start_date', '<', $dt["end_day"] ]
    ])->orderBy('start_date', 'asc')->get();

    for ($i=0; $i < $dt["first_day"]->diffInDays($dt["end_day"]); $i++){
      $schedule_count[$i] = 0;
      $date[$i] = $dt["first_day"]->copy()->addDay($i)->day == 1?
      $dt["first_day"]->copy()->addDay($i)->format('m月d日'):
      $dt["first_day"]->copy()->addDay($i)->day;
    }

    $list = array();
    foreach ($schedules as $data){
      $schedule_count[Carbon::parse($data->start_date)->diffInDays($dt["first_day"])]++;
      if ( $dt["first_day"]->diffInDays(Carbon::parse($data->start_date))  == $dt["first_day"]->diffInDays($dt["request"]) ){
        $list["time"][] = Carbon::parse($data->start_date)->format('H:i');
        $list["item"][] = $data->schedule_item;
        $list["location"][] = $data->location;
        $list["description"][] = $data->description;
      }
    }
    session(['select_view' => 'month', 'timestamp' => $request_date]);

    return view('monthly', [
      'request_dt' => $request_date,
      'calendar_date' => $date,
      'schedule_count' => $schedule_count,
      'total_days' => $dt["first_day"]->diffInDays($dt["end_day"]),
      'pointday' => $dt["first_day"]->diffInDays($dt["request"]),
      'list' => $list ]);
  }
}
