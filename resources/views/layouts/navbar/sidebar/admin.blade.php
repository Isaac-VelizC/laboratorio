<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:#168a82">
    <a href="{{ url('/') }}" class="brand-link">
      @php
          $short_name = \App\Models\SystemInfo::find(3);
          $logo = \App\Models\SystemInfo::find(5);
      @endphp
      <img src=" {{ $logo->meta_value ? asset('storage/'.$logo->meta_value) : asset('dist/img/avata-1.png') }}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ $short_name->meta_value }}</span>
    </a>
    <div class="sidebar">
      <nav class="mt-4">
        <ul class="nav nav-pills nav-sidebar flex-column text-md nav-compact nav-flat nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
         <li class="nav-item dropdown">
           <a href="{{ url('/') }}" class="nav-link nav-home">
             <i class="nav-icon fas fa-tachometer-alt"></i>
             <p>
               Panel de Control
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="{{ route('admin.list.citas') }}" class="nav-link nav-appointments">
             <i class="nav-icon fas fa-calendar"></i>
             <p>
             Citas
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="{{ route('admin.list.paciente') }}" class="nav-link nav-clients">
             <i class="nav-icon fas fa-users"></i>
             <p>
             Pacientes
             </p>
           </a>
         </li>
         @if (Auth::user()->type == 1)
          <li class="nav-header">Mantenimiento</li>
          <li class="nav-item dropdown">
            <a href="{{ route('admin.list.prueba') }}" class="nav-link nav-tests">
              <i class="nav-icon fas fa-th-list"></i>
              <p>
                Pruebas
              </p>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a href="{{ route('admin.list.user') }}" class="nav-link nav-user_list">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>
          <div class="nav-item dropdown">
            <button class="btn btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="nav-icon fas fa-cogs"></i> Configuración
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a href="{{ route('admin.system.info') }}" style="color: black;" class="dropdown-item">
                <p>
                  Configuración & Publicidad
                </p>
              </a>
              <a href="{{ route('admin.informe.info') }}" style="color: black;" class="dropdown-item">
                <p>
                  Informes
                </p>
              </a>
            </div>
          </div>
         @endif
       </ul>
     </nav>
    </div>
  </aside>