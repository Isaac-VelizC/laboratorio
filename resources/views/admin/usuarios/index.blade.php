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
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Lista de Usuarios</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <div class="float-start float-lg-end">
                    <a href="{{ route('admin.user.create') }}" class="btn btn-sm btn-primary gap-2" >
                        <span>Registrar Nuevo</span>
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
                            <th>Avatar</th>
                            <th>Nombre</th>
                            <th>Cedula de Identidad</th>
                            <th>Tipo de Usuario</th>
                            <th>Estado</th>
                            <tr></tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td class="text-center"><img src="{{ $item->avatar ? asset('storage/'.$item->avatar) : asset('imgs/2.jpg') }}" class="avatar" width="30" height="30" alt="user_avatar"></td>
                                <td>{{ $item->nombres }} {{ $item->apellido_pa }} {{ $item->apellido_ma }}</td>
                                <td ><p class="m-0 truncate-1">{{ $item->ci }} </p></td>
                                <td ><p class="m-0"> {{ $item->type == 1 ? "Administrador" : "Bioquimico"}}</p></td>
                                <td>
                                    @if ($item->status == 0 )
                                        <span class="badge bg-danger ">Inactivo</span>
                                    @else
                                        <span class="badge bg-secondary ">Activo</span>
                                    @endif
                                </td>
                                <td>
                                    <td class="text-center">
                                        <div class="flex align-items-center">
                                            <a class="px-1" href="{{ route('admin.user.edit', $item->id) }}">
                                                <i class="bi bi-pen"></i>
                                            </a>
                                            <a class="px-1" href="javascript:void(0)" onclick="confirmDelete({{ $item->id }})" data-bs-toggle="modal" data-bs-backdrop="false" data-bs-target="#modal-default">
                                                {{$item->status == 0 ? 'Activar' : 'Inhabilitar'}}
                                            </a>
                                        </div>
                                    </td>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!--Disabled Backdrop Modal -->
<div class="modal fade text-left" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel4">Confirmación</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form id="deleteForm" method="post" action="{{ route('admin.user.delete') }}">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <input type="hidden" name="id" value="">
                    <div class="modal-body">
                        <p>¿Quieres Continuar?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary"
                        data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Cerrar</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Continuar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmDelete(userId) {
        $('#modal-default').find('input[name="id"]').val(userId);
    }
</script>
@endsection