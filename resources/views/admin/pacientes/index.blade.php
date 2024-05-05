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
            <div class="col-8 col-md-6">
                <h3>Lista de Pacientes</h3>
            </div>
            <div class="col-4 col-md-6">
                <div class="float-start float-lg-end">
                    <a href="javascript:void(0)" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-backdrop="false" data-bs-target="#modal_create_pacientes">
                        Nuevo
                    </a>
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
                            <th>#</th>
                            <th>Nombre</th>
                            <th>CI/NIT</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Estado</th>
                            <tr></tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pacientes as $item)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td class=""><p class="m-0 truncate-1">{{ $item->user->nombres }} {{ $item->user->apellido_pa }} {{ $item->user->apellido_ma }}</p></td>
                                <td class=""><p class="m-0 truncate-1">{{ $item->user->ci }}</p></td>
                                <td class=""><p class="m-0 truncate-1">{{ $item->user->email }}</p></td>
                                <td class=""><p class="m-0 truncate-1">{{ $item->contact }}</p></td>
                                <td>
                                    @if ($item->user->status == 0 )
                                        <span class="badge bg-danger ">Inactivo</span>
                                    @else
                                        <span class="badge bg-secondary ">Activo</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="flex align-items-center">
                                        
                                        <a class="px-1" href="{{ route('admin.paciente.show', $item->id) }}">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        @if (auth()->user()->type == 1)
                                            <a class="px-1" href="{{ route('admin.paciente.edit', $item->id) }}">
                                                <i class="bi bi-pen"></i>
                                            </a>
                                            <a class="px-1" href="javascript:void(0)" onclick="confirmDelete({{ $item->id }})" data-bs-toggle="modal" data-bs-backdrop="false" data-bs-target="#modal-default">
                                                @if ($item->status == 0) <i class="bi bi-activity"></i> @else <i class="bi bi-trash"></i> @endif
                                            </a>
                                            <a class="px-1" href="{{ route('admin.cita.new.add', $item->id) }}">
                                                <i class="bi bi-file-earmark-plus"></i>
                                            </a>
                                            <a class="px-1" href="javascript:void(0)" onclick="confirmDelete({{ $item->id }})" data-bs-toggle="modal" data-bs-backdrop="false" data-bs-target="#modal-confirmacion">
                                                {{$item->user->status == 0 ? 'Activar' : 'Inhabilitar'}}
                                            </a>
                                        @endif
                                    </div>
                                </td>                                    
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @include('admin.pacientes.create')
</div>

<!--Disabled Backdrop Modal -->
<div class="modal fade text-left" id="modal-confirmacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel4">Confirmación</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form id="deleteForm" method="post" action="{{ route('admin.paciente.delete') }}">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <input type="hidden" name="id" value="">
                    <p>¿Estás seguro de eliminar este usuario de forma permanente?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary"
                        data-bs-dismiss="modal">
                        <i class="bi bi-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Cerrar</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <i class="bi bi-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Continuar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function confirmDelete(userId) {
        $('#modal-confirmacion').find('input[name="id"]').val(userId);
    }
</script>
@endsection