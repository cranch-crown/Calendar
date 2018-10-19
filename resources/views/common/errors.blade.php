@if (count($errors) > 0)
  <div class="alert alert-danger">
    <div><strong>おや…何かがおかしいようです…</strong></div>
    <div>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  </div>
@endif
