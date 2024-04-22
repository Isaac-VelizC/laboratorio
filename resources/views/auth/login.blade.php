@extends('layouts.app')

@section('content')
@php
  $name = \App\Models\SystemInfo::find(1);
  $logo = \App\Models\SystemInfo::find(5);
  $files = \App\Models\ImagenFile::all();
@endphp
<div id="auth">
  <div class="row h-100">
      <div class="col-lg-6 d-none d-lg-block">
        <section id="container-slider">	
          <ul class="listslider">
            @foreach ($files as $item)
            <?php $i = 0; ?>
            <li><a itlist="itList_{{ $i }}" href="#"></a></li>
            @endforeach
          </ul>
          <ul id="slider">
            @foreach ($files as $item)
              <li style="background-image: url({{ asset('storage/publicidad/' . $item->path) }}); z-index:0; opacity: 1;">
                <div class="content_slider" >
                  <div>
                    <center><img src="{{ $logo->meta_value ? asset('storage/'.$logo->meta_value) : asset('dist/img/avata-1.png') }}" height="100" width="100" alt="" class="avatar"></center>
                    <h1 class="text-center py-5 login-title"><b>{{ $name->meta_value }}</b></h1>
                  </div>
                </div>
              </li>
            @endforeach
         </ul>
        </section>
      </div>
      <div class="col-lg-6 col-12">
          <div id="auth-left">
              <p class="auth-subtitle mb-5 text-center">Iniciar Sesión</p>
              
              <form id="clogin-frm" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group position-relative has-icon-left mb-4">
                  <input id="username_or_email" type="text" class="form-control form-control-xl @error('username_or_email') is-invalid @enderror" name="username_or_email" required>
                  <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                  </div>
                  @error('username_or_email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                  <input id="password" type="password" class="form-control form-control-xl @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                  <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                  </div>
                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Ingresar</button>
              </form>
              <div class="text-center mt-5 text-lg fs-4">
                <p class="text-gray-600">¿No tienes cuenta? <a href="{{ url('register') }}" class="font-bold">Registrar</a></p>
            </div>
          </div>
      </div>
  </div>
</div>
@endsection
