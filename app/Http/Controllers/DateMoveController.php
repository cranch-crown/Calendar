<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class DateMoveController extends Controller
{
  public function dayrequest($i){
    return redirect('/'.session('select_view').'/'.Carbon::
      createFromTimestamp(session('calendar_start'))->addDay($i)->timestamp);
  }

  public function submonth(){
    return redirect('/month/'.Carbon::createFromTimestamp(session('timestamp'))->addMonthsNoOverflow(-1)->timestamp);
  }

  public function addmonth(){
    return redirect('/month/'.Carbon::createFromTimestamp(session('timestamp'))->addMonthsNoOverflow(1)->timestamp);
  }

  public function today(){
    return redirect('/month/'.Carbon::now()->timestamp);
  }

}