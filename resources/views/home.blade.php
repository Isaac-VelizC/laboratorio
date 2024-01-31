@extends('layouts.app')

@section('content')
    <div class="card">
        @if(auth()->user()->type != 3)
            <h2>Sistema de Laboratorio Clínico</h2>
            <hr class="border-info">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="info-box bg-gradient-light shadow">
                        <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-th-list"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-text">Pruebas</span>
                        <span class="info-box-number text-right">{{ $testListCount }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="info-box bg-gradient-light shadow">
                        <span class="info-box-icon  bg-gradient-primary elevation-1"><i class="fas fa-spinner"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-text">Citas Pendientes</span>
                        <span class="info-box-number text-right">{{ $citaListStatus0Count }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="info-box bg-gradient-light shadow">
                        <span class="info-box-icon  bg-gradient-primary elevation-1"><i class="fas fa-thumbs-up"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-text">Citas Aprobadas</span>
                        <span class="info-box-number text-right">{{ $citaListStatus123Count }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="info-box bg-gradient-light shadow">
                        <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-vial"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-text">Pruebas Terminadas</span>
                        <span class="info-box-number text-right">{{ $citaListStatus6Count }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="info-box bg-gradient-light shadow">
                        <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-text">Pacientes</span>
                        <span class="info-box-number text-right">{{ $clientListTotalCount }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        @endif
        @role('Cliente')
        <h3>Sistema de Laboratorio</h3>
        <hr class="border-primary">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="info-box bg-gradient-light shadow">
                    <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-spinner"></i></span>
        
                    <div class="info-box-content">
                    <span class="info-box-text">Citas Pendientes</span>
                    <span class="info-box-number text-right">{{ $pendientes }}</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="info-box bg-gradient-light shadow">
                    <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-thumbs-up"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-text">Citas Aprobadas</span>
                    <span class="info-box-number text-right">{{ $aprobadas }}</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="info-box bg-gradient-light shadow">
                    <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-vial"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-text">Pruebas Terminadas</span>
                    <span class="info-box-number text-right">{{ $terminadas }}</span>
                    </div>
                </div>
            </div>
        </div>
        <hr>        
        @endrole
    </div>
@endsection
