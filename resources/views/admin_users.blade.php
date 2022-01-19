@extends('inc.wrapper')
@section('_title')
Пользователи | {{ config('app.name', 'Laravel') }}
@endsection
@section('page_title')
  <h1>Зарегестрированные пользователи</h1>
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
          <div class="inner item_toggle" data-toggle="user_details">
            <h3>{{ $users->count()}}</h3>

            <p> Всего пользователей</p>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
          <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal_site"><small class="badge badge-danger"><i class="far fa-clock"></i> В работе</small> Добавить пользователя <i class="fas fa-plus-circle"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>


    <div class="row">
      <div class="col-12 _toggle" id="user_details">
        <div class="card">
          <div class="card-body">
            <table id="users_table" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>#</th>
                <th>Имя</th>
                <th>Логин (Email)</th>
                <th>Дата Обновления</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>
                      @if($user->is_admin)
                        <small class="badge badge-success"><i class="far fa-ok"></i>Admin</small>
                      @endif
                    {{ $user -> name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user-> updated_at }}</td>
                </tr>


                @endforeach

              </tbody>
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
@endsection


@section('scripts_after')
<!-- Toastr -->
<script src="{{ asset ("/bower_components/admin-lte/plugins/toastr/toastr.min.js") }}"></script>
<script>
$('.item_toggle').click(function(){
    var id = $(this).data('toggle')
    $('._toggle').each(function(i,item){
      if (item.id == id){
        $(item).toggle()
      } else {
        $(item).hide()
      }
    })
  })
</script>
<script>
  $(function () {
    dt_primaty('#statistics_table');
  })
</script>
@endsection
