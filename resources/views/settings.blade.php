@extends('inc.wrapper')
@section('_title', 'Настройки | referalCMS')
@section('page_title')
  <h1>Настройки реферьной программы</h1>
@endsection

@section('block_header')
  @parent
  <!--Additional styles and scripts!-->
  <link rel="stylesheet" href="/css/app.css">
@endsection

@section('page_content')
<section class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $settings_count }}</h3>

            <p>Реферальные программы</p>
          </div>
          <div class="icon">
            <i class="ion ion-plus"></i>
          </div>
          <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal_setting">Создать программу <i class="fas fa-plus-circle"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>


    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Список настроек</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="settings_table" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Название</th>
                <th>Реферальная ссылка</th>
                <th>Телефон</th>
                <th>Email</th>
                <th>Адрес</th>
                <th>Статус</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
                @foreach ($settings as $item)
                <tr>
                  <td><a href="?id={{ $item -> id }}">{{ $item -> settings_name }}</a></td>
                  <td><a href="http://{{ $item -> sites_url }}/?ref={{$item->setting_user_id}}">{{ $item -> sites_url }}/?ref={{$item->setting_user_id}}</a></td>
                  <td>{{ $item -> number }}</td>
                  <td>{{ $item -> email }}</td>
                  <td>{{ $item -> address }}</td>
                  <td>
                    <div class="form-group">
                      <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="_enabled_{{ $item->id }}" @if($item->enabled) checked="" @endif >
                        <label class="custom-control-label" for="_enabled__enabled_{{ $item->id }}"></label>
                      </div>
                    </div>
                  </td>
                  <td class="project-actions text-right">
                    <a class="btn btn-info btn-sm" href="?id={{ $item -> id }}">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Изменить
                    </a>
                  </td>
                </tr>

                @endforeach



              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>

@include('inc/modals/setting')

@endsection


@section('scripts_after')
<!-- Toastr -->
<script src="{{ asset ("/bower_components/admin-lte/plugins/toastr/toastr.min.js") }}"></script>

<script>
  $(function () {
    $('#settings_table').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "buttons": [{extend:"copy", text:"Копировать"},"csv", "excel", "pdf", ]
    }).buttons().container().appendTo('#settings_table_wrapper .col-md-6:eq(0)');
  });
</script>
@endsection
