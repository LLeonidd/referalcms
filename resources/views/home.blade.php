@extends('inc.wrapper')
@section('_title')
Главная | {{ config('app.name', 'Laravel') }}
@endsection
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
      @if ($default_setting)
      <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
          <span class="info-box-icon bg-success btn" title="Копировать реферальную ссылку" id="copy_ref"><i class="far fa-copy"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Перейти на сайт</span>
            <span class="info-box-number"><a target="_blank" href="{{ $default_setting->url}}/?ref={{ $user ->id }}">
              {{ $default_setting->url}}/?ref={{ $user ->id }}
            </a></span>
            <input style="height: 0px;" id="default_ref_link" value="{{ $default_setting->url}}/?ref={{ $user ->id }}">
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      @else
      <div class="col-md-8 col-sm-6 col-12">
        <div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h5><i class="icon fas fa-exclamation-triangle"></i> У Вас пока нет реферальной ссылки. Добавьте телефон (email или адрес) на странице <a href="/account/">Учетная запись</a></h5>
        </div>
      </div>

      @endif
    </div>


  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('scripts_after')
<script>
  $(function () {
    dt_primaty('#statistics_table');
  })
</script>
@endsection
