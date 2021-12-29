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

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Статистика переходов</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="statistics_table" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Переход из</th>
                <th>Сайт</th>
                <th>User-Agent</th>
                <!-- <th>Пользователь</th> -->
                <th>Дата визита</th>
                <th>Дата выхода</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($statistics as $item_stat)
                <tr>
                  <td>{{ $item_stat->referer_host }}</td>
                  <td>{{ $item_stat->url }}</td>
                  <td>{{ $item_stat->user_agent }}</td>
                  <!-- <td>{{$item_stat->name}}</td> -->
                  <td>{{ $item_stat->ca }}</td>
                  <td>{{ $item_stat->ce }}</td>
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
<!-- /.content -->
@endsection

@section('scripts_after')
<script>
  $(function () {
    $('#statistics_table').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "order": [[ 3, "desc" ]],
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "buttons": [{extend:"copy", text:"Копировать"},"csv", "excel", "pdf", {extend:"print", text:"Печатать"}, {extend:"colvis", text:"Отображать"}]
    }).buttons().container().appendTo('#statistics_table_wrapper .col-md-6:eq(0)');
  });
</script>
@endsection
