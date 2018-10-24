@extends('layouts.app')
@section('content')



<link rel="stylesheet" type="text/css" href="../css/monthly.css">

<!--カレンダーのヘッダ-->
<header class="calendar_header">
  <section class="display_month headbar_item">
    <h4>{{ $display_year }}年{{ $display_month }}月</h4>
  </section>

<!--ボタンツールバー-->
  <section class="headbar_item">
    <div class="btn-toolbar" role="toolbar" aria-label="カレンダーのボタン群">
      <div class="btn-group mr-2" role="group" aria-label="先月次月">
        <button type="button" class="btn btn-outline-secondary"><</button>
        <button type="button" class="btn btn-outline-secondary">></button>
      </div>
      <div class="btn-group mr-2" role="group" aria-label="今日">
        <button type="button" class="btn btn-outline-secondary">今日</button>
      </div>
      <div class="btn-group mr-2" role="group" aria-label="モード変更">
        <button type="button" class="btn btn-outline-secondary">年</button>
        <button type="button" class="btn btn-outline-secondary">週</button>
        <button type="button" class="btn btn-outline-secondary">日</button>
        <button type="button" class="btn btn-outline-secondary">予定リスト</button>
      </div>
    </div>
  </section>
</header>

<main>
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
            <div class="daybox-date"><a href="#">{{ $date[$x+($y*7)] }}</a></div>
            <div class="daybox-task">@if($schedule_count[$x+($y*7)] != 0){{$schedule_count}}件の予定@endif</div>
          </div>
        @endfor
      </section>
    @endfor

  </section>
  <!--予定リスト-->
  <div class="schedule-list">
    @if (count($schedules) >0)
      予定リストを表示させます。きっと。
    @else
      予定はありません！あなたはぼっちです！
    @endif
  </div>
</main>
@endsection