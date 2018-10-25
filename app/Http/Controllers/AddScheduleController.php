<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Schedule;
use Validator;
use Illuminate\Support\Facades\Auth;

class AddScheduleController extends Controller
{
  public function index($view,$dt) {
    session(['select_view' => $view, 'timestamp' => $dt]);
    return view('make_schedule');
  }

  public function save(Request $request) {
    $validator = Validator::make($request->all(),[
      'schedule_item' => 'required | max:300',
      'start_date' => 'required']);

    if($validator->fails()) {
      return redirect('/makeschedule/'.session('select_view').'/'.session('timestamp'))
      ->withInput()
      ->withErrors($validator);
    }
    $schedules = new Schedule;
    $schedules->user_id = Auth::id();
    $schedules->schedule_item = $request->schedule_item;
    $schedules->start_date = $request->start_date;
    $schedules->end_date = $request->end_date;
    $schedules->location = $request->location;
    $schedules->description = $request->description;
    $schedules->save();
    return redirect('/'.session('select_view').'/'.session('timestamp'));
  }
}
