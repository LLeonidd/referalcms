@extends('inc.wrapper')
@section('_title', 'Главная | referalCMS')
@section('page_title')
  <h1>Управление реферальной программой</h1>
@endsection

@section('block_header')
  @parent
  <!--Additional styles and scripts!-->
  <link rel="stylesheet" href="/css/app.css">
@endsection

@section('page_content')
  @if(Request::is('/'))
    <h2>Условный блок, который отображается на главной</h2>
  @endif

@endsection
