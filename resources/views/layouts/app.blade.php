<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Laboratorio Perez</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css')}}">

  <link rel="stylesheet" href="{{ asset('assets/vendors/choices.js/choices.min.css')}}" />
  <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/app.css')}}">
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg')}}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/carousel.css')}}">
</head>
<body>
    <div id="app">
        @if (auth()->check())
            @if (in_array('Cliente', Auth::user()->getRoleNames()->toArray()))
                @include('layouts.navbar.sidebar.cliente')
            @else
                @include('layouts.navbar.sidebar.admin')
            @endif 
                <div id="main" class="layout-navbar">
                    <header class="mb-2">
                        @include('layouts.navbar.nav')
                    </header>
                    <div id="main-content">
                        @yield('content')
                    </div>
                </div>
        @else
            @yield('content')
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js')}}"></script>
    <script src="{{ asset('assets/vendors/tinymce/tinymce.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/tinymce/plugins/code/plugin.min.js')}}"></script>
    <script>
        tinymce.init({ selector: '#default' });
        tinymce.init({ selector: '#dark', toolbar: 'undo redo styleselect bold italic alignleft aligncenter alignright bullist numlist outdent indent code', plugins: 'code autoresize', width: 900});
    </script>
    <script src="{{ asset('assets/vendors/choices.js/choices.min.js')}}"></script>
    <script>
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
    <script src="{{ asset('assets/js/main.js')}}"></script>
    <script src="{{ asset('assets/js/carousel.js')}}"></script>
    @yield('scripts')
</body>
</html>
