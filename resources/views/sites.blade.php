@extends('inc.wrapper')
@section('_title', 'Статистика переходов | referalCMS')
@section('page_title')
  <h1>Доступные сайты</h1>
@endsection

@section('block_header')
  @parent

  <!-- CodeMirror -->
    <link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/plugins/codemirror/codemirror.css") }}">
    <link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/plugins/codemirror/theme/monokai.css") }}">
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
          <div class="inner item_toggle" data-toggle="site_details">
            <h3>{{ $sites_count }}</h3>

            <p>Доступные сайты</p>
          </div>
          <div class="icon">
            <i class="ion ion-plus"></i>
          </div>
          <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal_site"><small class="badge badge-danger"><i class="far fa-clock"></i> В работе</small> Добавить сайт <i class="fas fa-plus-circle"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>


    <div class="row">
      <div class="col-12 _toggle" id="site_details">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Список сайтов</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="settings_table" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>#</th>
                <th>Адрес сайта</th>
                <!-- <th>Правила</th> -->
              </tr>
              </thead>
              <tbody>
                @foreach ($sites as $site)
                <tr>
                  <td>{{ $site->id }}</td>
                  <td>
                      @if($site->default)
                        <small class="badge badge-success"><i class="far fa-ok"></i>Default</small>
                      @endif
                    {{ $site->url }}</td>
                  <!-- <td>
                    @if ($site->rules)
                      <textarea id="codeMirror_{{ $site->id}}" class="code_mirror" style="display: none;">
                          {{ $site->rules }}
                      </textarea>
                    @endif
                  </td> -->
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
<!-- CodeMirror -->
<script src="{{ asset("/bower_components/admin-lte/plugins/codemirror/codemirror.js") }}"></script>
<script src="{{ asset("/bower_components/admin-lte/plugins/codemirror/mode/css/css.js") }}"></script>
<script src="{{ asset("/bower_components/admin-lte/plugins/codemirror/mode/xml/xml.js") }}"></script>
<script src="{{ asset("/bower_components/admin-lte/plugins/codemirror/mode/htmlmixed/htmlmixed.js") }}"></script>

<script>

  $(function () {
    // CodeMirror
    $('.code_mirror').each(function(i,item){
      CodeMirror.fromTextArea(item, {
        mode: "htmlmixed",
        theme: "monokai",
        //size: ()
      }).setSize(800, 300);

    })
  })
</script>
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
@endsection
