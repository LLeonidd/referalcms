@extends('inc.wrapper')
@section('_title')
Статистика переходов | {{ config('app.name', 'Laravel') }}
@endsection
@section('page_title')
  <h1>Статистика переходов</h1>
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
                <th>Дата визита</th>
                <!-- <th>Дата выхода</th> -->
                <th>User-Agent</th>
                @if(Auth::user()->is_admin)
                <th>Сессия</th>
                <th>Пользователь</th>
                @endif
              </tr>
              </thead>
              <tbody>
                @foreach ($statistics as $item_stat)
                <tr>
                  <td>{{ $item_stat->referer_host }}</td>
                  <td>{{ $item_stat->url }}</td>
                  <td>{{ $item_stat->ca }}</td>
                  <!-- <td>{{ $item_stat->ce }}</td> -->
                  <td>{{ $item_stat->user_agent }}</td>
                  @if(Auth::user()->is_admin)
                  <td>{{ $item_stat->session_id }}</td>
                  <td>{{$item_stat->name}}</td>
                  @endif
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
    dt_primary('#statistics_table', ordering=[[2,'desc']]);
  })
</script>
@endsection
