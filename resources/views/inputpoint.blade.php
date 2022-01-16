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

  //Referal scripts
  $URL_REFERAL_CRM = 'http://127.0.0.1:8000/index.php/api/inputpoint';
  function _request_to_refcms($url){
  	$data = json_encode(array(
  		'_headers' => array_change_key_case(getallheaders()),
  		'_ref' => $_GET['ref'] ?? NULL,
      '_session_id' => '12345678',
  	));



  	$ch = curl_init($url);
  	curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
  	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  	$response = curl_exec($ch);
  	curl_close($ch);
  	return $r = json_decode($response);
  }


  if(!empty($_GET['ref'])){
  	 session_unset();
  	 // Security check
  	 $_GET['ref'] = preg_replace("#[^a-z\_\-0-9]+#i",'',$_GET['ref']);
  	 if ($_GET['ref'] != '') {

  	   $r = _request_to_refcms($URL_REFERAL_CRM);
       echo($r);
  	   if ($r!=null){
  	     foreach ($r->setting as $data){
  	       echo $number = $data->number;
  	       echo $address = $data->address;
  	       echo $email = $data->email;
  	       echo $message = $data->message;
  	       echo $rules = $data->rules;
  	     }
  	     echo $r->statistic_id;
  	   }

  		 // write data in session
  		 //$_SESSION['ref_login'] = 'test_referal';
  	 }
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
