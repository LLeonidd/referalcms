@extends('inc.wrapper')
@section('_title')
Учетная запись | {{ config('app.name', 'Laravel') }}
@endsection
@section('page_title')
  <h1>Учетная запись</h1>
@endsection

@section('block_header')
  @parent
  <!--Additional styles and scripts!-->
  <link rel="stylesheet" href="/css/app.css">
@endsection

@section('page_content')

<!-- Main content -->
<section class="content">
  <div class="container-fluid">


    <div class="row">
      @if ($default_setting)
      <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
          <span class="info-box-icon bg-success btn" title="Копировать реферальную ссылку" id="copy_ref"><i class="far fa-copy"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Перейти на сайт</span>
            <span class="info-box-number"><a target="_blank" href="{{ $default_setting->url}}/?ref={{ $account ->id }}">
              {{ $default_setting->url}}/?ref={{ $account ->id }}
            </a></span>
            <input style="height: 0px;" id="default_ref_link" value="{{ $default_setting->url}}/?ref={{ $account ->id }}">
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      @else
      <div class="col-md-6 col-sm-6 col-12">
        <div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h5><i class="icon fas fa-exclamation-triangle"></i> У Вас пока нет реферальной ссылки. Добавьте телефон (email или адрес)</h5>
        </div>
      </div>

      @endif
    </div>



    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3 id="box_user_name">{{ $account -> name }}</h3>
            <p id="box_user_email"> {{ $account -> login}}</p>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
          <a href="#" class="small-box-footer update_user_btn" data-toggle="modal" data-target="#modal_user">Изменить <i class="fas fa-edit"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner item_toggle" data-toggle="phone_details">
            <h3>{{ $account->phone->count() }}<sup style="font-size: 20px"></sup></h3>
            <p>Привязано телефонов</p>
          </div>
          <div class="icon">
            <i class="ion ion-android-call"></i>
          </div>
          <a href="#" class="small-box-footer"  data-toggle="modal" data-target="#modal_phone" data-action="add">Добавить телефон <i class="fas fa-plus-circle"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner item_toggle" data-toggle="email_details">
            <h3>{{ $account->email->count() }}<sup style="font-size: 20px"></sup></h3>
            <p>Привязано Email-адресов</p>
          </div>
          <div class="icon">
            <i class="ion ion-android-mail"></i>
          </div>
          <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal_email" data-action="add">Добавить email <i class="fas fa-plus-circle"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-secondary">
          <div class="inner item_toggle" data-toggle="address_details">
            <h3>{{ $account->address->count() }}<sup style="font-size: 20px"></sup></h3>
            <p>Привязано адресов</p>
          </div>
          <div class="icon">
            <i class="ion ion-android-locate"></i>
          </div>
          <a href="add_address/" class="small-box-footer" data-toggle="modal" data-target="#modal_address"  data-action="add">Добавить адрес<i class="fas fa-plus-circle"></i></a>
        </div>
      </div>
      <!-- ./col -->

    </div>



    <div class="row" id="account_details">
      @if ( $account->phone->count() or $account->email->count() or $account->address->count())
      @if ($account->phone->count())
      <div class="col-md-12 item_account_detail" id="phone_details">
        <div class="card">
          <div class="card-header p-2">
            <h3 class="card-title">Телефоны</h3>
          </div><!-- /.card-header -->
          <div class="card-body">
            <table id="phones_table" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>#</th>
                <th>Телефон</th>
                <th>Сообщение в Whatsapp</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
              @foreach ($account -> phone as $phone)
              <tr>
                <td>{{ $phone -> id }}</td>
                <td class="phone_number_value">{{ $phone -> number }}</td>
                <td class="phone_message_value">{{ $phone -> message }} </td>
                <td class="project-actions text-right">
                  <a class="btn btn-info btn-sm phone_edit_btn"  href="#" data-id="{{ $phone->id }}" data-toggle="modal" data-target="#modal_phone"  data-action="edit" >
                      <i class="fas fa-pencil-alt">
                      </i>
                      Изменить
                  </a>
                </td>
              </tr>
              @endforeach
              </tbody>
            </table>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            <a class="btn btn-primary float-right" data-toggle="modal" data-target="#modal_phone"><i class="fas fa-plus"></i> Добавить телефон</a>
          </div>
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      @endif


      @if ($account->email->count())
      <div class="col-md-12 item_account_detail" id="email_details">
        <div class="card">
          <div class="card-header p-2">
            <h3 class="card-title">Emails</h3>
          </div><!-- /.card-header -->
          <div class="card-body">
            <table id="emails_table" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>#</th>
                <th>Email</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
              @foreach ($account -> email as $email)
              <tr>
                <td>{{ $email -> id }} </td>
                <td class="email_value">{{ $email -> email }} </td>
                <td class="project-actions text-right">
                  <a class="btn btn-info btn-sm email_edit_btn"  href="#" data-id="{{ $email->id }}" data-toggle="modal" data-target="#modal_email"  data-action="edit" >
                      <i class="fas fa-pencil-alt">
                      </i>
                      Изменить
                  </a>
                </td>
              </tr>
              @endforeach
              </tbody>
            </table>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            <a class="btn btn-primary float-right" data-toggle="modal" data-target="#modal_email"><i class="fas fa-plus"></i> Добавить email</a>
          </div>
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      @endif


      @if ($account->address->count())
      <div class="col-md-12 item_account_detail" id="address_details">
        <div class="card">
          <div class="card-header p-2">
            <h3 class="card-title">Адреса</h3>
          </div><!-- /.card-header -->
          <div class="card-body">
            <table id="addresses_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Адрес</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($account -> address as $address)
                <tr>
                  <td class="address_value">{{ $address -> address }} </td>
                  <td class="project-actions text-right">
                    <a class="btn btn-info btn-sm address_edit_btn"  href="#" data-id="{{ $address->id }}" data-toggle="modal" data-target="#modal_address"  data-action="edit" >
                        <i class="fas fa-pencil-alt">
                        </i>
                        Изменить
                    </a>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            <a class="btn btn-primary float-right" data-toggle="modal" data-target="#modal_address"><i class="fas fa-plus"></i> Добавить адрес</a>
          </div>
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      @endif



    @endif
    </div>

  </div>
</section>

@include('inc/modals/user')
@include('inc/modals/phone')
@include('inc/modals/email')
@include('inc/modals/address')

@endsection

@section('scripts_after')
<!-- Toastr -->
<script src="{{ asset ("/bower_components/admin-lte/plugins/toastr/toastr.min.js") }}"></script>
<!-- InputMask -->
<script src="{{ asset ("/bower_components/admin-lte/plugins/moment/moment.min.js") }}"></script>
<script src="{{ asset ("/bower_components/admin-lte/plugins/inputmask/jquery.inputmask.min.js") }}"></script>
@endsection

@push('scripts_after')
<script>
$('.item_toggle').click(function(){
    var id = $(this).data('toggle')
    $('.item_account_detail').each(function(i,item){
      if (item.id == id){
        $(item).toggle()
      } else {
        $(item).hide()
      }
    })
  })
</script>
<script>
  $('#copy_ref').click(function(){
    var copyText = document.getElementById("default_ref_link");
    copyText.select();
    document.execCommand("copy");
    toastr.success('Скопирована реферальная ссылка');
  })
</script>
<script>
  $(function () {
    $('#phones_table').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "order":[[0, 'desc']],
      "aoColumnDefs": [{ "bVisible": false, "aTargets": [0] }],
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  $(function () {
    $('#emails_table').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "order":[[0, 'desc']],
      "aoColumnDefs": [{ "bVisible": false, "aTargets": [0] }],
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  $(function () {
    $('#addresses_table').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

</script>

@endpush
