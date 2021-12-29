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
@php

{{

function _request_to_refcms(){
  $data = json_encode(array(
    '_headers' => getallheaders(),
    '_ref' => $_GET['ref'] ?? NULL,
  ));



  $ch = curl_init('http://127.0.0.1:8000/index.php/api/inputpoint');
  curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $response = curl_exec($ch);
  curl_close($ch);
  return $r = json_decode($response);
}

  $r = _request_to_refcms();

  if ($r!=null){
    foreach ($r->setting as $data){
      echo $number = $data->number;
      echo $address = $data->address;
      echo $email = $data->email;
      echo $message = $data->message;
    }
    echo $r->statistic_id;
  }


}}

@endphp

@endsection
@section('scripts_after')
  <!-- <script>
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
  </script> -->
@endsection
