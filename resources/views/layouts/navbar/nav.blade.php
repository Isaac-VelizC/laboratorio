
<style>
    .user-img{
          position: absolute;
          height: 27px;
          width: 27px;
          object-fit: cover;
          left: -7%;
          top: -12%;
    }
    .btn-rounded{
          border-radius: 50px;
    }
</style>
<nav class="main-header navbar navbar-expand navbar-light" style="background-color:#168a82">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        @php
            $titulo = \App\Models\SystemInfo::find(1);
        @endphp
        <a href="/" class="nav-link"><b>{{ $titulo->meta_value }}</b></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <div class="btn-group nav-link">
              <button type="button" class="btn btn-rounded badge badge-light dropdown-toggle dropdown-icon" data-toggle="dropdown">
                <span><img src="{{ Auth::user()->avatar ? asset('storage/'.Auth::user()->avatar) : asset('dist/img/avata-1.png') }}" class="img-circle elevation-2 user-img" alt="User Image"></span>
                <span class="ml-4">{{ Auth::user()->name }}</span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu" role="menu">
                @role('Cliente')
                  <a class="dropdown-item" href="{{ route('cliente.perfil') }}"><span class="fa fa-user"></span> Mi Cuenta</a>
                  <div class="dropdown-divider"></div>
                @endrole
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                      <span class="fas fa-sign-out-alt"></span>
                      Cerrar Sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
              </div>
          </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
