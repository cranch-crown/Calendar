@extends('layouts.app')
@section('content')

@php
use Carbon\Carbon;
@endphp


<link rel="stylesheet" type="text/css" href="{{ asset('/css/monthly.css') }}">

<main>
  <!--カレンダーのヘッダ-->
  <div class="calendar-header">
    <h2 class="display_month">
      {{ Carbon::createFromTimestamp("$request_dt")->format("Y") }}年{{ Carbon::createFromTimestamp("$request_dt")->format("m") }}月
    </h2>

    <!--ボタンツールバー-->
    <div class="headbar_buttons">
      <div class="btn-toolbar" role="toolbar" aria-label="カレンダーのボタン群">
        <div class="btn-group mr-2" role="group" aria-label="先月次月">
          <form action="{{ url('/submonth/.$request_timestamp') }}" method="POST">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-outline-secondary"><</button>
            <input type="hidden" name="">
          </form>
          <form action="{{ url('/addmonth') }}" method="POST">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-outline-secondary">></button>
          </form>
        </div>
        <div class="btn-group mr-2" role="group" aria-label="今日">
          <form action="{{ url('') }}" method="POST">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-outline-secondary">今日</button>
          </form>
        </div>
        <!-- 実装予定機能
        <div class="btn-group mr-2" role="group" aria-label="モード変更">
          <form action="{{ url('') }}" method="POST">
            {{ csrf_field() }}</form>
          <button type="submit" class="btn btn-outline-secondary">年</button>
          <form action="{{ url('') }}" method="POST">
            {{ csrf_field() }}</form>
          <button type="submit" class="btn btn-outline-secondary">週</button>
          <form action="{{ url('') }}" method="POST">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-outline-secondary">日</button>
          </form>
        </div>
        -->

        <div class="btn-group" role="group" aria-label="リスト表示ボタン">
          <form action="{{ url('') }}" method="POST">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-outline-secondary">予定リスト</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!--カレンダー本体-->
  <section class="calendar">
    <section class="topbar">
      <div class="topbar-days">日</div>
      <div class="topbar-days">月</div>
      <div class="topbar-days">火</div>
      <div class="topbar-days">水</div>
      <div class="topbar-days">木</div>
      <div class="topbar-days">金</div>
      <div class="topbar-days">土</div>
    </section>

    @for($y=0; $y < ($total_days/7); $y++)
      <section class="calendar-week">
        @for($x=0; $x < 7;$x++)
          <div class="daybox">
            <div class="daybox-date">
              <a href="#">{{ $calendar_date[$x+($y*7)] }}</a>
            </div>
            @if($schedule_count[$x+($y*7)] != 0)
              <div class="daybox-task">
                {{ $schedule_count[$x+($y*7)] }}件の予定
              </div>
            @endif
          </div>
        @endfor
      </section>
    @endfor

  </section>

  <!--予定リスト-->
  <div class="schedulelist">
    <div class="list-header">
      <h3>
        {{ Carbon::createFromTimestamp("$request_dt")->format("m") }}
        /{{ Carbon::createFromTimestamp("$request_dt")->format("d") }}の予定
      </h3>
        <form action="{{ url('/makeschedule/month/'.$request_dt) }}" method="POST">
          {{ csrf_field() }}
          <button type="submit" class="btn btn-outline-dark">予定を追加</button>
        </form>
    </div>
    @for($i=0; $i < $schedule_count[$pointday]; $i++)
      <a class="list-item">
        <div class="item-top">
          <h4 class="item-time">{{ $list['time'][$i] }}</h4>
          <div class="item-name">{{ $list['item'][$i] }}</div>
        </div>
        <div class="item-bottom">
          <div class="item-location">場所：{{ $list['location'][$i] }}</div>
          <div class="item-description">{{ $list['description'][$i] }}
          </div>
        </div>
      </a>
    @endfor
  </div>

</main>
@endsection