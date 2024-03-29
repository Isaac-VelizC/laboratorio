@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<style>
    html, body{
      height:calc(100%) !important;
      width:calc(100%) !important;
    }
    .login-title{
      text-shadow: 2px 2px black
    }
    #login{
      flex-direction:column !important
    }
    #logo-img{
        height:150px;
        width:150px;
        object-fit:scale-down;
        object-position:center center;
        border-radius:100%;
    }
    #login .col-7,#login .col-5{
      width: 100% !important;
      max-width:unset !important
    }
    body {
        background: rgb(197, 255, 202);
        background-size: cover;
        background-repeat: no-repeat;
    }
    #dynamic_slide_show {
      position: relative;
      z-index: 1;
    }

    .login-container {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 2;
    }

</style>

@php
$name = \App\Models\SystemInfo::find(1);
$logo = \App\Models\SystemInfo::find(5);
$files = \App\Models\ImagenFile::all();
@endphp

<div class="login-container">
  <div class="h-100 d-flex align-items-center w-100" id="login">
    <div class="col-7 h-100 d-flex align-items-center justify-content-center">
      <div class="w-100">
        <center><img src="{{ $logo->meta_value ? asset('storage/'.$logo->meta_value) : asset('dist/img/avata-1.png') }}" alt="" id="logo-img"></center>
        <h1 class="text-center py-5 login-title"><b>{{ $name->meta_value }}</b></h1>
      </div>
    </div>
    <div class="col-5 h-100 bg-gradient">
      <div class="d-flex w-100 h-100 justify-content-center align-items-center">
        <div class="card col-sm-12 col-md-6 col-lg-3 card-outline card-primary rounded-0 shadow">
          <div class="card-header rounded-0">
            <h4 class="text-purle text-center"><b>Iniciar Sesión</b></h4>
          </div>
          <div class="card-body rounded-0">
            <form id="clogin-frm" method="POST" action="{{ route('login') }}">
                @csrf
              <div class="input-group mb-3">
                <input id="username_or_email" type="text" class="form-control @error('username_or_email') is-invalid @enderror" name="username_or_email" value="{{ old('username_or_email') }}" required autofocus>
                @error('username_or_email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-8">
                    <a class="btn btn-link" href="{{ route('register') }}">
                        {{ __('Crear cuenta') }}
                    </a>
                </div>
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="dynamic_slide_show" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <?php $i = 0; ?>
    @foreach($files as $image)
      <li data-target="#dynamic_slide_show" data-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}"></li>
      <?php $i++; ?>
    @endforeach
  </ol>
  <div class="carousel-inner">
    <?php $i = 0; ?>
    @foreach($files as $image)
      <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
        <img src="{{ asset('storage/publicidad/' . $image->path) }}" alt="Slide {{ $i }}" class="d-block w-100">
      </div>
      <?php $i++; ?>
    @endforeach
  </div>
</div>

@endsection
