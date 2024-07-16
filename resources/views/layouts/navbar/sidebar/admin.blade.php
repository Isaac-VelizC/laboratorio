@php
  $short_name = \App\Models\SystemInfo::find(3);
  $logo = \App\Models\SystemInfo::find(5);
@endphp
<div id="sidebar" class="active">
  <div class="sidebar-wrapper active" style="background-color:#168a82">
      <div class="sidebar-header">
        <div class="d-flex justify-content-between">
            <div class="logo flex">
                <a href="{{ url('/') }}" class="d-flex justify-center gap-2">
                    <img src="{{ asset('storage/'.$logo->meta_value) }}" class="avatar avatar-md" alt="Logo">
                    <h5 class="">{{ $short_name->meta_value }}</h5>
                </a>
            </div>
            <div class="toggler">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
      </div>
      <div class="sidebar-menu">
          <ul class="menu">
              <li class="sidebar-title">Menu</li>
              <li class="sidebar-item {{ Route::is('home') ? 'active' : '' }}">
                  <a href="{{ url('/') }}" class='sidebar-link'>
                      <i class="bi bi-grid-fill"></i>
                      <span>Panel de Control</span>
                  </a>
              </li>
              <li class="sidebar-item {{ Route::is('admin.list.citas') ? 'active' : '' }} ">
                <a href="{{ route('admin.list.citas') }}" class='sidebar-link'>
                    <i class="bi bi-calendar-check-fill"></i>
                    <span>Citas</span>
                </a>
              </li>
              <li class="sidebar-item {{ Route::is('admin.list.paciente') ? 'active' : '' }}">
                <a href="{{ route('admin.list.paciente') }}" class='sidebar-link'>
                    <i class="bi bi-people-fill"></i>
                    <span>Pacientes</span>
                </a>
              </li>
              @role('Admin')
                <li class="sidebar-title">Mantenimiento</li>
                <li class="sidebar-item {{ Route::is('admin.list.prueba') ? 'active' : '' }}">
                    <a href="{{ route('admin.list.prueba') }}" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical-fill"></i>
                        <span>Pruebas</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Route::is('admin.list.user') ? 'active' : '' }}">
                    <a href="{{ route('admin.list.user') }}" class='sidebar-link'>
                        <i class="bi bi-person-check-fill"></i>
                        <span>Usuarios</span>
                    </a>
                </li>
                <li class="sidebar-item has-sub {{ Route::is('admin.system.info') || Route::is('admin.informe.info') ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-pen-fill"></i>
                        <span>Configuración</span>
                    </a>
                    <ul class="submenu ">
                        @role('Admin')
                        <li class="submenu-item {{ Route::is('admin.system.info') ? 'active' : '' }}">
                            <a href="{{ route('admin.system.info') }}">Configuración & Publicidad</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.page.packups') ? 'active' : '' }}">
                            <a href="{{ route('admin.page.packups') }}">Copias de Seguridad</a>
                        </li>
                        @endrole
                        <li class="submenu-item {{ Route::is('admin.informe.info') ? 'active' : '' }}">
                            <a href="{{ route('admin.informe.info') }}">Informes</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.informe.info2') ? 'active' : '' }}">
                            <a href="{{ route('admin.informe.info2') }}">Informes Bioquimico</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.informe.info3') ? 'active' : '' }}">
                            <a href="{{ route('admin.informe.info3') }}">Informes Pacientes</a>
                        </li>
                    </ul>
                </li>
                @endrole
          </ul>
      </div>
      <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
  </div>
</div>