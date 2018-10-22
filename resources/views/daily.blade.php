@extends('layouts.app')
@section('content')


<div class="container">
  <!-- リクエストで何日か表示させる予定 -->
  @include('common.errors')
  <h4>
    ○月○日の予定
    <form action="{{ url('make-schedule') }}" method="POST">
      {{ csrf_field() }}
      <div class="col-md-1">
        <button type="submit" class="btn btn-outline-dark rounded-circle p-0" style="width:2rem;height:2rem;">＋</button>
      </div>
    </form>
  </h4>

  @if(count($schedules) > 0)
    <div class="list-group">
      @foreach($schedules as $schedule)
        <div class="list-group-item">{{ $schedule->schedule_item }}</div>
      @endforeach
    </div>
  @endif

</div>

@endsection