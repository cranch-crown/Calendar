<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{

  public function index() {
    if(Auth::check()) {
      $dt = Carbon::now();
      /*ユーザー設定機能追加予定*/
      return redirect('/month/'.$dt->timestamp);
    }
    return view('welcome');
  }
}
