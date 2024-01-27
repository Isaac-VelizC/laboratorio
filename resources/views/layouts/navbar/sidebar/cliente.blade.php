<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:#168a82">
    <a href="{{ url('/') }}" class="brand-link">
      <img src="{{ asset('dist/img/avatar-1.png') }}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
           @php
               $short_name = \App\Models\SystemInfo::find(3);
           @endphp
         <span class="brand-text font-weight-light">{{ $short_name->meta_value }}</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link nav-home">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Panel de Control
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('cliente.citas') }}" class="nav-link nav-appointments">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Mis Citas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('cliente.resultados') }}" class="nav-link nav-reports">
              <i class="nav-icon fas fa-file-medical-alt"></i>
              <p>
                Resultado Pruebas
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>