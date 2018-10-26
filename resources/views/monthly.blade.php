@extends('layouts.app')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('/css/monthly.css') }}">

<section>
  <!--カレンダーのヘッダ-->
  <div class="calendar-header">
    <h2 class="display_month">
      {{ $displaydt["year"] }}年{{ $displaydt["month"] }}月
    </h2>

    <!--ボタンツールバー-->
    <div class="headbar_buttons">
      <div class="btn-toolbar" role="toolbar" aria-label="カレンダーのボタン群">
        <div class="btn-group mr-2" role="group" aria-label="先月次月">
            <a class="btn btn-outline-secondary" href="{{ url('/back_month') }}" role="button"><</a>
            <a class="btn btn-outline-secondary" href="{{ url('/advance_month') }}" role="button">></a>
        </div>
        <div class="btn-group mr-2" role="group" aria-label="今日">
          <a class="btn btn-outline-secondary" href="{{ url('/request/month-today') }}" role="button">今日</a>
        </div>
        <!-- 実装予定
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

        <div class="btn-group" role="group" aria-label="リスト表示ボタン">
          <form action="{{ url('') }}" method="POST">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-outline-secondary">予定リスト</button>
          </form>
        </div>
        -->
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
              <a href="{{ url('/dayrequest/'.(($y*7)+$x)) }}">{{ $calendar_date[($y*7)+$x] }}</a>
            </div>
            @if($schedule_count[($y*7)+$x] != 0)
              <div class="daybox-task">
                {{ $schedule_count[($y*7)+$x] }}件の予定
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
      <h4>
        {{ $displaydt["month"] }}/{{ $displaydt["day"] }}の予定
      </h4>
      <a class="btn btn-outline-dark" href="{{ url('/makeschedule/month/'.$dt_request) }}" role="button">予定を追加</a>
    </div>
    @for($i=0; $i < $schedule_count[$pointday]; $i++)
      <div class="list-container">
        <div class="item-time">{{ $list["time"][$i] }}</div>
        <div class="item-name">{{ $list["item"][$i] }}</div>
        <form action="{{ url('/schedule/edit') }}" method="POST">
          <button type="submit" class="btn btn-outline-success e-button">編集</button>
          <input type="hidden" name="id" value="{{$id[$i]}}">
          {{ csrf_field() }}
        </form>
        <div class="item-location">@if(!$list["location"]==="")場所：{{ $list["location"][$i] }}@endif</div>
        <div class="item-description">@if(!$list["description"]===""){{ $list["description"][$i] }}@endif</div>
        <button type="button" class="btn btn-outline-danger d-button">削除</button>
      </div>
    @endfor
  </div>

</section>
@endsection