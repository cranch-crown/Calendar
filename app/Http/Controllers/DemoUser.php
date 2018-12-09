<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\User;

class DemoUser extends Controller
{
  public function createDemouser() {
    $users = new User;
    $users->name = 'デモユーザー';
    $users->email = Carbon::now()->timestamp.'@test.com';
    $users->password = Carbon::now()->timestamp;
    $users->save();
    return redirect('/');
  }
}
