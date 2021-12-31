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

@yield('scripts_after')
@stack('scripts_after')
</body>
</html>
