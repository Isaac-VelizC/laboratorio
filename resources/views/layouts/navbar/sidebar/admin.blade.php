<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:#168a82">
    <a href="{{ url('/') }}" class="brand-link">
      <img src="{{ asset('dist/img/avatar-1.png') }}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">SIS-LABORATORIO</span>
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
          <li class="nav-item dropdown">
            <a href="{{ route('admin.system.info') }}" class="nav-link nav-system_info">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Configuración & Publicidad
              </p>
            </a>
          </li>
         @endif
       </ul>
     </nav>
    </div>
  </aside>