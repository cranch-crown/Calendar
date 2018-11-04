<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Schedule;
use Validator;
use Illuminate\Support\Facades\Auth;

class AddScheduleController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function newschedule($view,$dt) {
        return view('schedule_editor', [
            'value_start_date' => Carbon::createFromTimestamp(session('timestamp'))->format('Y-m-d'),
            'value_start_time' => Carbon::now()->addHour(1)->format('H:00'),
            'value_end_date' => Carbon::createFromTimestamp(session('timestamp'))->format('Y-m-d'),
            'value_end_time'=> Carbon::now()->addHour(2)->format('H:00')]);
    }

    public function save(Request $request) {
        $validator = Validator::make($request->all(),[
            'schedule_item' => 'required | max:300',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required',
            'location' => 'max:300',
            'description' => 'max:300']);

        if ($validator->fails()) {
            return redirect('/makeschedule/'.session('select_view').'/'.session('timestamp'))->withInput()->withErrors($validator);
        }
        $schedules = new Schedule;
        $schedules->user_id = Auth::user()->id;
        $schedules->schedule_item = $request->schedule_item;
        $schedules->start_date = $request->start_date.' '.$request->start_time;
        $schedules->end_date = $request->end_date.' '.$request->end_time;
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
    $schedules->end_date:
    Carbon::parse($schedules->end_date)->format('Y-m-d\TH:i:s');
    return view('schedule_update', [
        'schedule' => $schedules,
        'value_start_date' => Carbon::parse($schedules->start_date)->copy()->format('Y-m-d'),
        'value_start_time' => Carbon::parse($schedules->start_date)->copy()->format('H:i'),
        'value_end_date' => empty($schedules->end_date)?
        $schedules->end_date: Carbon::parse($schedules->end_date)->copy()->format('Y-m-d'),
        'value_end_time' => empty($schedules->end_date)?
        $schedules->end_date: Carbon::parse($schedules->end_date)->copy()->format('H:i')]);
  }

  public function update(Request $request) {
    $validator = Validator::make($request->all(),[
        'schedule_item' => 'required | max:300',
        'start_date' => 'required',
        'start_time' => 'required',
        'end_date' => 'required',
        'end_time' => 'required',
        'location' => 'max:300',
        'description' => 'max:300']);

    if($validator->fails()) {
      return redirect('/schedule/edit')
      ->withInput()
      ->withErrors($validator);
    }

    $schedules = Schedule::find($request->id);
    $schedules->schedule_item = $request->schedule_item;
    $schedules->start_date = $request->start_date.' '.$request->start_time;
    $schedules->end_date = $request->end_date.' '.$request->end_time;
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
