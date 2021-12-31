@extends('inc.wrapper')
@section('_title', 'Аккаунт | referalCMS')
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
          <div class="inner">
            <h3>{{ $account->phone->count() }}<sup style="font-size: 20px"></sup></h3>
            <p>Привязано телефонов</p>
          </div>
          <div class="icon">
            <i class="ion ion-android-call"></i>
          </div>
          <a href="#" class="small-box-footer"  data-toggle="modal" data-target="#modal_phone">Добавить телефон <i class="fas fa-plus-circle"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ $account->email->count() }}<sup style="font-size: 20px"></sup></h3>
            <p>Привязано Email-адресов</p>
          </div>
          <div class="icon">
            <i class="ion ion-android-mail"></i>
          </div>
          <a href="add_email/" class="small-box-footer" data-toggle="modal" data-target="#modal_email">Добавить email <i class="fas fa-plus-circle"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-secondary">
          <div class="inner">
            <h3>{{ $account->address->count() }}<sup style="font-size: 20px"></sup></h3>
            <p>Привязано адресов</p>
          </div>
          <div class="icon">
            <i class="ion ion-android-locate"></i>
          </div>
          <a href="add_address/" class="small-box-footer" data-toggle="modal" data-target="#modal_address">Добавить адрес<i class="fas fa-plus-circle"></i></a>
        </div>
      </div>
      <!-- ./col -->

    </div>



    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#phones" data-toggle="tab">Телефоны</a></li>
              <li class="nav-item"><a class="nav-link" href="#emails" data-toggle="tab">Emails</a></li>
              <li class="nav-item"><a class="nav-link" href="#addresses" data-toggle="tab">Адреса</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane active" id="phones">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Список добавленных телефонов</h3>
                  </div>
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
                          <a class="btn btn-info btn-sm phone_edit_btn"  href="#" data-id="{{ $phone->id }}" data-toggle="modal" data-target="#modal_phone_edit">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Изменить
                          </a>
                        </td>
                      </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                    <a class="btn btn-primary float-right" data-toggle="modal" data-target="#modal_phone"><i class="fas fa-plus"></i> Добавить телефон</a>
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="emails">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Список добавленных Email</h3>
                  </div>
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
                        <td>{{ $email -> email }} </td>
                        <td class="project-actions text-right">
                          <a class="btn btn-info btn-sm" href="edit_email/?id={{ $email -> id }}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Изменить
                          </a>
                        </td>
                      </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                    <a href="add_phone/" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal_email"><i class="fas fa-plus"></i> Добавить Email</a>
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="addresses">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Список добавленных адресов</h3>
                  </div>
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
                        <td>{{ $address -> address }} </td>
                        <td class="project-actions text-right">
                          <a class="btn btn-info btn-sm" href="edit_address/?id={{ $address -> id }}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Изменить
                          </a>
                        </td>
                      </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                    <a href="add_address/" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal_address"><i class="fas fa-plus"></i> Добавить адрес</a>
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

    </div>
  </div>
</section>

@include('inc/modals/user')
@include('inc/modals/phone')
@include('inc/modals/phone_edit')
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
