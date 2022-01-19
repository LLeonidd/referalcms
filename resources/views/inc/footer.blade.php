<!-- Main Footer -->
<footer class="main-footer">
  <!-- To the right -->
  <div class="float-right d-none d-sm-inline">
    Anything you want
  </div>
  <!-- Default to the left -->
  <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset ("/bower_components/admin-lte/plugins/jquery/jquery.min.js") }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset ("/bower_components/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset ("/bower_components/admin-lte/dist/js/adminlte.min.js") }}"></script>

<!-- DataTables  & Plugins -->
<script src="{{ asset ("/bower_components/admin-lte/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset ("/bower_components/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
<script src="{{ asset ("/bower_components/admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js") }}"></script>
<script src="{{ asset ("/bower_components/admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}"></script>
<script src="{{ asset ("/bower_components/admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js") }}"></script>
<script src="{{ asset ("/bower_components/admin-lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js") }}"></script>
<script src="{{ asset ("/bower_components/admin-lte/plugins/jszip/jszip.min.js") }}"></script>
<script src="{{ asset ("/bower_components/admin-lte/plugins/pdfmake/pdfmake.min.js") }}"></script>
<script src="{{ asset ("/bower_components/admin-lte/plugins/pdfmake/vfs_fonts.js") }}"></script>
<script src="{{ asset ("/bower_components/admin-lte/plugins/datatables-buttons/js/buttons.html5.min.js") }}"></script>
<script src="{{ asset ("/bower_components/admin-lte/plugins/datatables-buttons/js/buttons.print.min.js") }}"></script>
<script src="{{ asset ("/bower_components/admin-lte/plugins/datatables-buttons/js/buttons.colVis.min.js") }}"></script>

<script>
  //hooks
  var remove_default = function(api, node, config){$(node).removeClass('btn-secondary')}
  var toolbar_buttons = [
    {extend:"copy", text:"<i class='fa fa-copy'></i>", title:"Копировать", className:"btn-default", init:remove_default },
    {extend:"csv", text:"<i class='fas fa-file-csv'></i>", title:"Экспорт в CSV", className:"btn-default", init:remove_default },
    {extend:"excel", text:"<i class='far fa-file-excel'></i>", title:"Экспорт в EXCEL", className:"btn-default",init:remove_default },
    {extend:"pdf", text:"<i class='far fa-file-pdf'></i>", title:"Экспорт в PDF", className:"btn-default",init:remove_default },
    {extend:"print", text:"<i class='fas fa-print'></i>", title:"Отправить на печать", className:"btn-default",init:remove_default },
    {extend:"colvis", text:"<i class='fas fa-sliders-h'></i>", title:"Отображать колонки", className:"btn-default",init:remove_default }
  ]
  var table_languages = {
    "search": "Поиск:",
    "info":           "Показано _START_ из _END_ всего _TOTAL_ записей",
    "infoEmpty":      "Показано 0 из 0 всего 0 записей",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Показать записей: _MENU_",
    "zeroRecords":    "Не найдено записей",
    "paginate": {
        "first":      "В начало",
        "last":       "В конец",
        "next":       "Следующая",
        "previous":   "Назад"
    },
  }
  var dt_primaty = function(table_id){
    $(table_id).DataTable({
      "paging": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      'iDisplayLength': 50,
      "language": table_languages,
      "buttons": toolbar_buttons,
    }).buttons().container().appendTo(`${table_id}_wrapper .col-md-6:eq(0)`);
  }
</script>

@yield('scripts_after')
@stack('scripts_after')
</body>
</html>
