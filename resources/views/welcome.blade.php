@extends('layouts.app')

@section('content')

<div class="container">
  <div class="page-header">
    <h1>MWSへようこそ！</h1>
  </div>

  <div class="panel-body">
    このアプリケーションは製作者がLavel習得のため開発をしているカレンダーアプリケーションです。
    下記ボタンから新規登録、もしくはログインしてお使いください。
    <a type="button" class="btn btn-primary btn-block" href="{{ url('/register') }}" role="button">
      新規登録
    </a>
    <a type="button" class="btn btn-outline-primary btn-block" href="{{ url('/login') }}" role="button">
      ログイン
    </a>
  </div>

  <!--テスト用ログアウトボタン-->



</div>

@endsection
