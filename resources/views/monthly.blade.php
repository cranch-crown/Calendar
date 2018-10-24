@extends('layouts.app')
@section('content')

<link rel="stylesheet" type="text/css" href="../css/reboot.css">
<link rel="stylesheet" type="text/css" href="../css/monthly.css">

<main>

  <!--カレンダーのヘッダ-->
  <div class="calendar-header">
    <h2 class="display_month">
      {{ $display_year }}年{{ $display_month }}月
    </h2>

    <!--ボタンツールバー-->
    <div class="headbar_buttons">
        <div class="btn-toolbar" role="toolbar" aria-label="カレンダーのボタン群">
          <div class="btn-group mr-2" role="group" aria-label="先月次月">
            <form action="{{ url('') }}">
              <button type="submit" class="btn btn-outline-secondary"><</button>
            </form>
            <button type="submit" class="btn btn-outline-secondary">></button>
          </div>
          <div class="btn-group mr-2" role="group" aria-label="今日">
            <button type="submit" class="btn btn-outline-secondary">今日</button>
          </div>
          <div class="btn-group mr-2" role="group" aria-label="モード変更">
            <button type="submit" class="btn btn-outline-secondary">年</button>
            <button type="submit" class="btn btn-outline-secondary">週</button>
            <button type="submit" class="btn btn-outline-secondary">日</button>
          </div>
          <div class="btn-group" role="group" aria-label="リスト表示ボタン">
            <button type="submit" class="btn btn-outline-secondary">予定リスト</button>
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
            <div class="daybox-date"><a href="#">{{ $calendar_date[$x+($y*7)] }}</a></div>
            <div class="daybox-task">@if($schedule_count[$x+($y*7)] != 0){{$schedule_count}}件の予定@endif</div>
          </div>
        @endfor
      </section>
    @endfor

  </section>

  <!--予定リスト-->
  <div class="schedulelist">
    <div class="list-header">
      <h3>
        {{$display_month}}/{{$display_day}}の予定
      </h3>
        <button type="submit" class="btn btn-outline-dark">予定を追加</button>
    </div>
    @for($i=0; $i < $schedule_count[$pointday]; $i++)
      <a class="list-item">
        <div class="item-top">
          <h4 class="item-time">{{ $list_time[i] }}</h4>
          <div class="item-name">{{ $list_item[i] }}</div>
        </div>
        <div class="item-bottom">
          <div class="item-location">場所：{{ $list_location[i] }}</div>
          <div class="item-description">{{ $list_description[i] }}
          </div>
        </div>
      </a>
    @endfor
  </div>

</main>
@endsection