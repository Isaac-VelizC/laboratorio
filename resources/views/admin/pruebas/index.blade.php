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
		<h3 class="card-title">Lista de Pruebas</h3>
		<div class="card-tools">
			<a href="{{ route('admin.form.new.prueba') }}" id="create_new" class="btn btn-flat btn-sm btn-primary" ><span class="fas fa-plus"></span> Nuevo</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table id="example1" class="table table-bordered table-hover table-striped">
				<colgroup>
					<col width="5%">
					<col width="20%">
					<col width="25%">
					<col width="20%">
					<col width="15%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr class="bg-gradient-primary text-light">
						<th>#</th>
						<th>Fecha de Creación</th>
						<th>Nombre</th>
						<th>Precio</th>
						<th>Estado</th>
						<th>Acción</th>
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
                                @if ($item->status == 0)
                                    <span class="rounded-pill badge badge-danger col-6">Inactivo</span>
                                @else
                                    <span class="rounded-pill badge badge-primary col-6">Activo</span>
                                @endif
                            </td>
                            <td align="center">
                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        Acción
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item view_data" href="{{ route('admin.prueba.show', $item->id) }}" data-id ="{{ $item->id }}"><span class="fa fa-eye text-dark"></span> Ver</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item edit_data" href="{{ route('admin.form.edit.prueba', $item->id) }}"><span class="fa fa-edit text-primary"></span> Editar</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item delete_data" href="javascript:void(0)" onclick="confirmDelete({{ $item->id }})" data-toggle="modal" data-target="#modal-confirmacion">
                                        <span class="fa fa-trash text-danger"></span> Eliminar
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-confirmacion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmación</h4>
            </div>
            <form id="deleteForm" method="post" action="{{ route('admin.prueba.delete') }}">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" value="">
                <div class="modal-body">
                    <p>¿Estás seguro de eliminar esta prueba?</p>
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
        $('#modal-confirmacion').find('input[name="id"]').val(userId);
    }
</script>
@endsection