@extends('layouts.app')
@section('content')

<div class="container">
  <!-- 予定入力フォーム -->
  <div class="panel-body">
    <form action="{{ url('save-schedule') }}" method="POST" class="form-horizontal">

      <!--スケジュールフォーム-->
      <div class="form-group">
        <label for="schedule_item">スケジュール名</label>
        <input type="text" id="schedule_item" name="schedule_item" class="form-control">
      </div>

      <!--予定時間-->
      <div class="form-group">
        <label for="">予定時間</label>
        <div class="form-inline">
          <!-- jquery timedropperで日付時刻入力補助予定 -->
          <input type="datetime-local" id="schedule_time" name="schedule_time" class="form-control  " autocomplete="on">～
          <input type="datetime-local" id="schedule_endtime" name="schedule_endtime" class="form-control">
        </div>
      </div>

      <!--場所？-->
      <div class="form-group">
        <label for="">場所？</label>
        <input type="text" id="location" name="" class="form-control">
      </div>

      <!--メモ？-->
      <div class="form-group">
        <label for="">メモ予定？</label>
        <input type="text" id="description" name="" class="form-control">
      </div>

      <button type="submit" class="btn btn-outline-dark">保存<btn>
      <!--予定表示領域-->
        {{ csrf_field() }}
    </form>
  </div>
</div>

@endsection