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
            <div class="col-10 col-md-6">
                <h3>Lista de Pruebas</h3>
            </div>
            <div class="col-2 col-md-6">
                <div class="float-start float-lg-end">
                    <a href="{{ route('admin.form.new.prueba') }}" class="btn btn-sm btn-primary gap-2" >
                        <i class="bi bi-clipboard-plus d-sm-none"></i>
                        <span class="d-none d-sm-block">Nuevo</span>
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
                            <th>Registro</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Estado</th>
                            <tr></tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pruebas as $item)
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td class="">{{ date("Y-m-d H:i",strtotime($item->created_at)) }}</td>
                                <td class=""><p class="m-0 truncate-1">{{ $item->name }}</p></td>
                                <td class="">{{ number_format($item->cost, 2) }}</td>
                                <td class="text-center">
                                    @if ($item->delete == 1)
                                        <span class="badge bg-danger">Inactivo</span>
                                    @else
                                        <span class="badge bg-success">Activo</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="flex align-items-center">
                                        <a class="px-1" href="{{ route('admin.prueba.show', $item->id) }}">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a class="px-1" href="{{ route('admin.form.edit.prueba', $item->id) }}">
                                            <i class="bi bi-pen"></i>
                                        </a>
                                        <a class="px-1" href="javascript:void(0)" onclick="confirmDelete({{ $item->id }})" data-bs-toggle="modal" data-bs-backdrop="false" data-bs-target="#modal-confirmacion">
                                            <i class="bi bi-trash"></i>
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

<!--Disabled Backdrop Modal -->
<div class="modal fade text-left" id="modal-confirmacion" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel4" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
    role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel4">Confirmación
            </h4>
            <button type="button" class="close" data-bs-dismiss="modal"
                aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>
        <form id="deleteForm" method="post" action="{{ route('admin.delete') }}">
            @csrf
            @method('DELETE')
            <div class="modal-body">
                <input type="hidden" name="id" value="">
                <div class="modal-body">
                    <p>¿Estás seguro de eliminar esta prueba?</p>
                </div>
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
        console.log('hola');
        $('#modal-confirmacion').find('input[name="id"]').val(userId);
    }
</script>
@endsection