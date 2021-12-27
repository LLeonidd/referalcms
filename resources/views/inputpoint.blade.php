@extends('inc.wrapper')
@section('_title', 'Статистика переходов | referalCMS')
@section('page_title')
  <h1>Симулятор реферала</h1>
@endsection

@section('block_header')
  @parent
  <!--Additional styles and scripts!-->
  <link rel="stylesheet" href="/css/app.css">
@endsection

@section('page_content')

@endsection

@section('scripts_after')
  <script>
  //alert('{{ csrf_token() }}')
  $(function() {
    $.ajax({
      url: '{{ route('inputpoint.refdata_store') }}',
      type: "POST",
      data: {title:'title',text:'text'},
      headers: {
        'X-CSRF-Token': '{{ csrf_token() }}'
      },
      success: function (data) {
        console.log(data);
      },
      error: function (msg) {
        console.log(msg);
      }
    });
  })
  </script>
@endsection
