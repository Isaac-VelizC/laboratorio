@extends('layouts.app')

@section('content')
    <div class="card">
        @role('Admin')
        <P>aDMIN</P>
        @endrole
        @role('Cliente')
        <h3>Sistema de Laboratorio</h3>
        <hr class="border-primary">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="info-box bg-gradient-light shadow">
                    <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-calendar"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-text">Citas Reservadas</span>
                    <span class="info-box-number text-right">5</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="info-box bg-gradient-light shadow">
                    <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-spinner"></i></span>
        
                    <div class="info-box-content">
                    <span class="info-box-text">Citas Pendientes</span>
                    <span class="info-box-number text-right">5</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="info-box bg-gradient-light shadow">
                    <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-thumbs-up"></i></span>
        
                    <div class="info-box-content">
                    <span class="info-box-text">Citas Aprobadas</span>
                    <span class="info-box-number text-right">7</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="info-box bg-gradient-light shadow">
                    <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-vial"></i></span>
        
                    <div class="info-box-content">
                    <span class="info-box-text">Pruebas Terminadas</span>
                    <span class="info-box-number text-right">0</span>
                    </div>
                </div>
            </div>
        </div>
        <hr>        
        @endrole
    </div>
@endsection
