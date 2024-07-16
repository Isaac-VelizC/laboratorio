@extends('layouts.app')

@section('content')

<div class="page-heading">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible show fade">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="page-title">
        <div class="row">
            <div class="col-8 col-md-6">
                <h3>Copias de Seguridad</h3>
            </div>
            <div class="col-4 col-md-6">
                <div class="float-start float-lg-end">
                    <form action="{{ route('backup.run') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Nuevo Copia de seguridad</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Tamaño</th>
                            <tr></tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($backups as $item)
                            <tr>
                                <td>{{ basename($item['path']) }}</td>
                                <td>{{ number_format($item['size'] / 1048576, 2) }} MB</td>
                                <td class="text-center">
                                    <div class="flex align-items-center">
                                        <a href="{{ route('backup.delete', basename($item['path'])) }}">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        <a class="px-1" href="">
                                            <i class="bi bi-download"></i>
                                        </a>
                                    </div>
                                </td>                                    
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

@endsection