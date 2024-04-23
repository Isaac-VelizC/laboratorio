@extends('layouts.app')

@section('content')
<div class="page-heading">
    @if(session('message'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('message') }}
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
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pruebas {{ isset($prueba->name) ? $prueba->name : 'N/A' }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <div class="float-start float-lg-end gap-1">
                    <a href="{{ route('admin.list.prueba') }}" class="btn btn-sm btn-info gap-2" >
                        <span>Salir</span>
                    </a>
                    <a href="{{ route('admin.form.edit.prueba', $prueba->id) }}" class="btn btn-sm btn-primary gap-2" >
                        <i class="bi bi-clipboard-plus"></i>
                        <span>Editar Prueba</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                        <dt class="text-muted">Nombre de Prueba</dt>
                        <dd class='pl-4 fs-4 fw-bold'>{{ isset($prueba->name) ? $prueba->name : 'N/A' }}</dd>
                        <dt class="text-muted">Costo</dt>
                        <dd class='pl-4 fs-4 fw-bold'>{{ isset($prueba->cost) ? number_format($prueba->cost,2) : '0.00' }}</dd>
                        <dt class="text-muted">Estado</dt>
                        <dd class='pl-4 fs-4 fw-bold'>
                            @if ($prueba->delete === 1)
                                <span class="badge bg-primary">Inactivo</span>
                            @else
                                <span class="badge-danger">Activo</span>
                            @endif
                        </dd>
                </div>
                <br>
                <div class="row">
                    @foreach ($prueba->values as $item)
                        @php
                            $cleanedName = str_replace('@', '', $item->name);
                        @endphp
                        <div class="form-group col-3">
                            <label for="{{ $cleanedName }}" class="control-label">{{ $cleanedName }}</label>
                            <input class="form-control form-control-border" required 
                                type="{{ $item->type }}"
                                name="{{ $item->name }}"
                                id="{{ $item->name }}"
                                disabled
                                @if ($item->type == 'number') step="any" @endif
                            />
                        </div>
                    @endforeach
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-muted">Formulario</h2>
                        <div class="">{!! $prueba->description !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection