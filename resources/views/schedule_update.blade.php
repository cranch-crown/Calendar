@extends('layouts.app')
@include('common.errors')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('/css/make.css') }}">

<div class="container">
  <!-- 予定入力フォーム -->
  <div class="panel-body">
    <form action="{{ url('/schedule/update') }}" method="POST" class="form-horizontal">

      <!--スケジュールフォーム-->
      <div class="form-group">
        <label for="schedule_item">タイトル</label>
        <input type="text" id="schedule_item" name="schedule_item" class="form-control" value="{{ $schedule->schedule_item }}">
      </div>

      <!--予定時間-->
      <div class="form-group">
        <label for="date">予定時間</label>
        <div class="form-inline">

          <input type="datetime-local" id="start_date" name="start_date" class="form-control  " autocomplete="on" value="{{ $schedule->start_date }}">～
          <input type="datetime-local" id="end_date" name="end_date" class="form-control" value="{{ $schedule->end_date }}">
        </div>
      </div>

      <div class="form-group">
        <label for="location">場所</label>
        <input type="text" id="location" name="location" class="form-control" value="{{ $schedule->location }}">
      </div>

      <div class="form-group">
        <label for="">メモ</label>
        <input type="text" id="description" name="description" class="form-control" value="{{ $schedule->description }}">
      </div>

      <div class="container" style="display:flex; align-items:center;">
      <button type="submit" class="btn btn-outline-dark mr-4">保存</button>
      <input type="hidden" name="id" value="{{ $schedule->id}}">
      {{ csrf_field() }}
      <a href="{{ url('/returnview') }}">カレンダーへ戻る</a>
      </div>

    </form>
  </div>
</div>

@endsection