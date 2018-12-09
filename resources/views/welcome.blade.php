@extends('layouts.app')

@section('content')

<div class="container">
  <div class="page-header">
    <h1>MWSへようこそ！</h1>
  </div>

  <div class="panel-body">
    このアプリケーションは製作者がLaravel習得のため開発をしているカレンダーアプリケーションです。
    下記ボタンから新規登録、もしくはログインしてお使いください。
    <a class="btn btn-primary btn-block" href="{{ url('/register') }}" role="button">
      新規登録
    </a>
    <a class="btn btn-outline-primary btn-block" href="{{ url('/login') }}" role="button">
      ログイン
    </a>
    新機能！デモユーザー機能を実装しました。ユーザー登録不要でお試し頂けます。
    <a class="btn btn-info btn-block" href="{{ url('/demo_start') }}" role="button">デモユーザーとしてログイン</a>
  </div>
</div>
@endsection
