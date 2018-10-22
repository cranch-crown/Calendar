@extends('layouts.app')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('css/monthly.css') }}">

<!--カレンダーを書き上げる予定-->
<div class="container">
  <div class="panel-body">
    {{ $display_month }}月のカレンダーを表示するよ
    {{ $calendar_first_day }}から表示を始めるよ
    @if (count ($schedules) >0)
      予定があってよかったね！リア充氏ね！
    @else
      ぼっち！仲間！
    @endif
  </div>
</div>


@endsection