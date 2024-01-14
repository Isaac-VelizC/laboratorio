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
                    @if (count($citas) > 0)
                        @foreach ($citas as $item)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td class="">fecha</td>
                                <td class="">{{ $item->code }}</td>
                                <td class=""><p class="m-0 truncate-1">{{ $item->test }}</p></td>
                                <td class="text-center">Estado</td>
                                <td align="center">
                                    <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                            Acción
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" href=""><span class="fa fa-eye text-dark"></span> Ver</a>
                                        @if ($item->status <= 1)
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item edit_data" href="javascript:void(0)" data-id ="{{ $item->id }}"><span class="fa fa-edit text-primary"></span> Editar</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="{{ $item->id }}"><span class="fa fa-trash text-danger"></span> Eliminar</a>    
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <p class="text-center">No hay Citas</p>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Fecha de Creación</th>
                        <th>Código</th>
                        <th>Prueba</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@include('clients.citas.modal_new')
@endsection
