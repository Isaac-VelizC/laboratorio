@extends('layouts.app')

@section('content')
<style>
    .img-thumb-path{
        width:100px;
        height:80px;
        object-fit:scale-down;
        object-position:center center;
    }
</style>
@if(session('message'))
       <div id="myAlert" class="alert alert-left alert-success alert-dismissible fade show mb-3 alert-fade" role="alert">
           <span>{{ session('message') }}</span>
           <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
   @endif
   @if(session('error'))
       <div id="myAlert" class="alert alert-left alert-danger alert-dismissible fade show mb-3 alert-fade" role="alert">
           <span>{{ session('error') }}</span>
           <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
   @endif
<div class="card card-outline card-primary rounded-0 shadow">
    <div class="card-header">
        <h3 class="card-title">Lista de mis Citas</h3>
        <div class="card-tools">
            <button id="create_new" class="btn btn-flat btn-sm btn-primary" data-toggle="modal" data-target="#modal-lg"><span class="fas fa-plus"></span> Nueva Cita</button>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table id="example1" class="table table-bordered table-hover table-striped">
                <colgroup>
                    <col width="5%">
                    <col width="20%">
                    <col width="15%">
                    <col width="30%">
                    <col width="15%">
                    <col width="15%">
                </colgroup>
                <tr class="bg-gradient-primary text-light">
                    <th>#</th>
                    <th>Fecha de Creación</th>
                    <th>Código</th>
                    <th>Prueba</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
                <tbody>
                        @foreach ($citas as $item)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td class="">fecha</td>
                                <td class="">{{ $item->code }}</td>
                                <td class="">
                                    @foreach ($item->pruebas as $h)
                                    <p class="m-0 truncate-1">{{ $h->test->name }}, </p>
                                    @endforeach
                                </td>
                                <td class="text-center">Estado</td>
                                <td align="center">
                                    <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                            Acción
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" href="{{ route('admin.cita.show', $item->id) }}"><span class="fa fa-eye text-dark"></span> Ver</a>
                                        @if ($item->status <= 1)
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item edit_data" href="javascript:void(0)" data-id ="{{ $item->id }}" data-toggle="modal" data-target="#modal-edit{{ $item->id }}"><span class="fa fa-edit text-primary"></span> Editar</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item delete_data" href="javascript:void(0)" onclick="confirmDelete({{ $item->id }})" data-toggle="modal" data-target="#modal-confirmacion">
                                                <span class="fa fa-trash text-danger"></span> Eliminar
                                            </a>
                                            @endif
                                    </div>
                                </td>
                            </tr>
                            @include('clients.citas.edit')
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('clients.citas.modal_new')
<div class="modal fade" id="modal-confirmacion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmación</h4>
            </div>
            <form id="deleteForm" method="post" action="{{ route('admin.citas.delete') }}">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" value="">
                <div class="modal-body">
                    <p>¿Estás seguro de eliminar este usuario de forma permanente?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Continuar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmDelete(userId) {
        // Actualizar el valor del campo 'id' en el formulario antes de mostrar el modal
        $('#modal-confirmacion').find('input[name="id"]').val(userId);
    }
</script>
@endsection
