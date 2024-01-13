<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Perez</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
    @if (auth()->check())
        <div class="wrapper">
            @if (in_array('Cliente', Auth::user()->getRoleNames()->toArray()))
                @include('layouts.navbar.sidebar.cliente')
            @else
                @include('layouts.navbar.sidebar.admin')
            @endif
                @include('layouts.navbar.nav')                
                <div class="content-wrapper">
                    <section class="content">
                        @yield('content')
                    </section>
                </div>
            <footer class="main-footer">
              <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.0.0
              </div>
              <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
              reserved.
            </footer>
        </div>
    @else
        @yield('content')
    @endif
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../dist/js/adminlte.min.js"></script>
    <script src="../../dist/js/demo.js"></script>
</body>
</html>
