@extends('layouts.app')

@section('content')

<div class="container">
  <div class="panel-body">
    {{ $display_month }}月のカレンダーを表示するよ
    {{ $calendar_first_day }}から表示を始めるよ
  </div>
</div>

@endsection