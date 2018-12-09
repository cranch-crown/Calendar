<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
/*use App\User;*/
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DemoUser extends Controller
{
  public function createDemouser() {
    $id = DB::table('users')->insertGetId([
      'name' => 'デモユーザー',
      'email' => Carbon::now()->timestamp.'@test.com',
      'password' => bcrypt(Carbon::now()->timestamp)
    ]);
    /*$users = new User;
    $users->name = 'デモユーザー';
    $users->email = Carbon::now()->timestamp.'@test.com';
    $users->password = Carbon::now()->timestamp;
    $users->save();*/
    return redirect('/');
  }
}
