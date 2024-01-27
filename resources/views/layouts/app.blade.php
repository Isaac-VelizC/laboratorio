<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Perez</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/select2.min.css')}}"/>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
    @if (auth()->check())
        <div class="wrapper">
        @include('layouts.navbar.nav')
        @if (in_array('Cliente', Auth::user()->getRoleNames()->toArray()))
            @include('layouts.navbar.sidebar.cliente')
        @else
            @include('layouts.navbar.sidebar.admin')
        @endif 
            <div class="content-wrapper">
                <br>
                <section class="content">
                    @yield('content')
                </section>
            </div>
        </div>
    @else
        @yield('content')
    @endif
    <script src="{{ asset('dist/js/adminlte.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('plugins/chart.js/Chart.min.js')}}"></script>
    <script src="{{ asset('plugins/sparklines/sparkline.js')}}"></script>
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <script src="{{ asset('dist/js/adminlte.js')}}"></script>
    <script src="{{ asset('dist/js/pages/dashboard.js')}}"></script>
    <script src="{{ asset('dist/js/demo.js')}}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2.min.js')}}"></script>
    @yield('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
                .create( document.querySelector( '#editordescripcionCreate' ) )
                .catch( error => {
                    console.error( error );
                } );
        ClassicEditor
                .create( document.querySelector( '#editordescripcionEdit' ) )
                .catch( error => {
                    console.error( error );
                } );
        ClassicEditor
                .create( document.querySelector( '#descriptionInforme' ) )
                .catch( error => {
                    console.error( error );
                } );
    </script>
    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
      </script>
</body>
</html>
