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
    while($dt->dayOfWeek != 6)
      $dt = $dt->addDay();
    return $dt->addDay();
  }

  public function month($request_date){
    $dt = [
      "request" => Carbon::createFromTimestamp($request_date),
      "calendar_start" => $this->getStartDay(Carbon::createFromTimestamp($request_date)->copy()),
      "calendar_end" => $this->getEndDay(Carbon::createFromTimestamp($request_date)->copy()) ];

    $schedules = Schedule::where([
      ['start_date', '>=', $dt["calendar_start"] ],
      ['start_date', '<', $dt["calendar_end"] ]
    ])->orderBy('start_date', 'asc')->get();

    for ($i=0; $i < $dt["calendar_start"]->diffInDays($dt["calendar_end"]); $i++){
      $schedule_count[$i] = 0;
      $date[$i] = $dt["calendar_start"]->copy()->addDay($i)->day == 1?
      $dt["calendar_start"]->copy()->addDay($i)->format('m月d日'):
      $dt["calendar_start"]->copy()->addDay($i)->day;
    }

    $list = array();
    foreach ($schedules as $data){
      $schedule_count[Carbon::parse($data->start_date)->diffInDays($dt["calendar_start"])]++;
      if ( $dt["calendar_start"]->diffInDays(Carbon::parse($data->start_date)) ==
        $dt["calendar_start"]->diffInDays($dt["request"]) ){
        $list["time"][] = Carbon::parse($data->start_date)->format('H:i');
        $list["item"][] = $data->schedule_item;
        $list["location"][] = $data->location;
        $list["description"][] = $data->description;
      }
    }
    session(['select_view' => 'month', 'timestamp' => $request_date, 'calendar_start' => $dt["calendar_start"]->timestamp]);

    return view('monthly', [
      'dt_request' => $request_date,
      'dt_calendarstart' => $dt["calendar_start"]->timestamp,
      'calendar_date' => $date,
      'schedule_count' => $schedule_count,
      'total_days' => $dt["calendar_start"]->diffInDays($dt["calendar_end"]),
      'pointday' => $dt["calendar_start"]->diffInDays($dt["request"]),
      'list' => $list ]);
  }
}
