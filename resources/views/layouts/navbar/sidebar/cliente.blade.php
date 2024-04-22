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
              <li class="sidebar-item {{ Route::is('cliente.citas') ? 'active' : '' }}">
                <a href="{{ route('cliente.citas') }}" class='sidebar-link'>
                    <i class="bi bi-calendar-check-fill"></i>
                    <span>Mis Citas</span>
                </a>
              </li>
              <li class="sidebar-item {{ Route::is('cliente.resultados') ? 'active' : '' }}">
                <a href="{{ route('cliente.resultados') }}" class='sidebar-link'>
                  <i class="bi bi-file-earmark-medical-fill"></i>
                    <span>Resultados Pruebas</span>
                </a>
              </li>
          </ul>
      </div>
      <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
  </div>
</div>