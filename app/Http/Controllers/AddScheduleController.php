<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Schedule;
use Validator;
use Illuminate\Support\Facades\Auth;

class AddScheduleController extends Controller
{
  public function newschedule($view,$dt) {
    session(['select_view' => $view, 'timestamp' => $dt]);
    return view('schedule_editor', [
      'now' => Carbon::createFromTimestamp(
        session('timestamp'))->format('Y-m-d\T').
        Carbon::now()->format('H:i:s') ]);
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
    $schedules->user_id = Auth::user()->id;
    $schedules->schedule_item = $request->schedule_item;
    $schedules->start_date = $request->start_date;
    $schedules->end_date = $request->end_date;
    $schedules->location = $request->location;
    $schedules->description = $request->description;
    $schedules->save();
    return redirect('/'.session('select_view').'/'.session('timestamp'));
  }

  public function returnview(){
    return redirect('/'.session('select_view').'/'.session('timestamp'));
  }

  public function edit(Request $request) {
    $schedules = Schedule::where('id', '=', $request->id)->first();
    $schedules->start_date = Carbon::parse($schedules->start_date)->format('Y-m-d\TH:i:s');
    $schedules->end_date = empty($schedules->end_date)?
    $schedules->end_date :
    Carbon::parse($schedules->end_date)->format('Y-m-d\TH:i:s');
    return view('schedule_update', ['schedule' => $schedules]);
  }

  public function update(Request $request) {
    $validator = Validator::make($request->all(),[
      'schedule_item' => 'required | max:300',
      'start_date' => 'required']);

    if($validator->fails()) {
      return redirect('/schedule/edit')
      ->withInput()
      ->withErrors($validator);
    }

    $schedules = Schedule::find($request->id);
    $schedules->schedule_item = $request->schedule_item;
    $schedules->start_date = $request->start_date;
    $schedules->end_date = $request->end_date;
    $schedules->location = $request->location;
    $schedules->description = $request->description;
    $schedules->save();
    return redirect('/'.session('select_view').'/'.session('timestamp'));
  }

  public function delete(Request $request) {
    Schedule::find($request->id)->delete();
    return redirect('/'.session('select_view').'/'.session('timestamp'));
  }
}
