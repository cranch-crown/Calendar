<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DemoUser extends Controller
{
  public function createDemouser() {
    $id = DB::table('users')->insertGetId([
      'name' => 'デモユーザー',
      'email' => uniqid().'@example.test',
      'password' => bcrypt(uniqid()),
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now()
    ]);
    Auth::loginUsingId($id);
    return redirect('/');
  }
}
