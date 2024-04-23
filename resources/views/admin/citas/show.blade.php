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
    @include('admin.citas.pagos')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detalles de tu Cita Reservada</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <div class="float-start float-lg-end">
                    @if ($cita->status >= 1)
                        <button class="btn btn-sm btn-danger" type="button" data-bs-toggle="modal" data-bs-backdrop="false" data-bs-target="#modal_show_pago"><i class="fa fa-upload"></i> Pago</button>
                    @endif
                    @if(auth()->user()->type == 1 || auth()->user()->type == 2 )
                        <button class="btn btn-sm btn-info" type="button" data-bs-toggle="modal" data-bs-backdrop="false" data-bs-target="#modal-estado"> Cambiar Estado</button>
                    @endif
                    @role('Cliente')
                        <?php if(isset($cita->status) && $cita->status == 0): ?>
                            <button class="btn btn-sm btn-danger" type="button"  onclick="confirmDelete({{ $cita->id }})" data-bs-toggle="modal" data-bs-backdrop="false" data-bs-target="#modal-confirmacion">
                                <i class="fa fa-trash"></i> Eliminar
                            </button>
                        <?php endif; ?>
                        <a class="btn btn-default border btn-flat btn-sm" href="{{ route('cliente.citas') }}" id="delete_data"><i class="fa fa-angle-left"></i> Volver</a>
                    @endrole
                    @if(auth()->user()->type == 1 || auth()->user()->type == 2 )
                        <a class="btn btn-default border btn-flat btn-sm" href="{{ route('admin.list.citas') }}"> Volver</a>
                    @endif
                </div>
            </div>  
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="container-fluid" id="outprint">
                    <div class="row">
                        <div class="col-2 border bg-primary text-light">Código de Cita</div>
                        <div class="col-4 border">{{ isset($cita->code) ? $cita->code :"" }}</div>
                        <div class="col-2 border bg-primary text-light">Calendario</div>
                        <div class="col-4 border">{{ isset($cita->fecha) ? $cita->fecha . ' ' . $cita->horario :"" }}</div>
                        <div class="col-2 border bg-primary text-light">Nombre Paciente</div>
                        <div class="col-10 border">{{ isset($cita->client) ? $cita->client->user->nombres .' '. $cita->client->user->apellido_pa.' '. $cita->client->user->apellido_ma :"" }}</div>
                        <div class="col-1 border bg-primary text-light">Sexo</div>
                        <div class="col-3 border">{{ isset($cita->client) ? $cita->client->gender :"" }}</div>
                        <div class="col-1 border bg-primary text-light">Teléfono</div>
                        <div class="col-3 border">{{ isset($cita->client) ? $cita->client->contact :"" }}</div>
                        <div class="col-1 border bg-primary text-light">Correo</div>
                        <div class="col-3 border">{{ isset($cita->client) ? $cita->client->user->email :"" }}</div>
                        <div class="col-2 border bg-primary text-light">Dirección</div>
                        <div class="col-10 border">{{ isset($cita->client) ? $cita->client->address :"" }}</div>
                        <div class="col-2 border bg-primary text-light">Estado</div>
                        <div class="col-4 border ">
                            <?php 
                                switch ($cita->status){
                                    case 0:
                                        echo '<span class="">Pendiente</span>';
                                        break;
                                    case 1:
                                        echo '<span class">Aprobado</span>';
                                        break;
                                    case 2:
                                        echo '<span class">Muestra Recogida</span>';
                                        break;
                                    case 3:
                                        echo '<span class="rounde">Entregado al laboratorio</span>';
                                        break;
                                    case 4:
                                        echo '<span class">Finalizado</span>';
                                        break;
                                    case 5:
                                        echo '<span class">Cancelado</span>';
                                        break;
                                }
                            ?>
                        </div>   
                        <div class="col-2 border bg-primary text-light">Prescripción</div>
                        <div class="col-4 border ">
                            @if (isset($cita->prescription))
                                <a href='{{ asset('storage/'.$cita->prescription) }}' target='_blank' download='{{ $cita->prescription }}'>{{ $cita->prescription }}</a>
                            @else
                                N/A
                            @endif
                        </div>
                    </div>
                    <hr>
                    <fieldset>
                        <legend class="text-muted">Lista de Pruebas</legend>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="bg-primary text-light">
                                    <th class="text-center">#</th>
                                    <th>Nombre</th>
                                    <th>Costo</th>
                                    @if ($cita->status >= 1)
                                        @if(auth()->user()->type == 1)
                                            <th>Llenar Informe</th>
                                        @endif
                                    @endif
                                    @if ($cita->status >= 2)
                                        @if(auth()->user()->type == 2)
                                            <th>Llenar Informe</th>
                                        @endif
                                    @endif
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cita->pruebas as $item)
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td>{{ $item->test->name }}</td>
                                        <td class="text-right">{{ number_format($item->test->cost ,2) }}</td>
                                        @if ($cita->status >= 1)
                                            <td><a href="{{ route('admin.llenar.form', [$item->test->id, $cita->id]) }}">Llenar</a></td>
                                            <td>
                                                @if ($item->estado == 0 )
                                                    <span style="padding: 2px 10px; color: white; background: red; font-size: 12px; border-radius: 20px;">Falta</span>
                                                @else
                                                    <span style="padding: 5px 10px; background: blue; color: white; font-size: 12px; border-radius: 20px; ">Listo</span>
                                                @endif
                                            </td>
                                        @else
                                            <td>
                                                <span style="padding: 2px 10px; color: white; background: red; font-size: 12px; border-radius: 20px;">En espera</span>
                                            </td>
                                        @endif
                                        @if ($item->pdf)
                                            <td><a href="{{ asset('storage/'.$item->pdf) }}" download='{{ $item->pdf }}'>{{ $item->pdf }}</a></td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </fieldset>
                    <hr>
                    <fieldset>
                        <legend class="text-muted">Historial</legend>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="bg-primary text-light">
                                    <th class="text-center">#</th>
                                    <th>Fecha</th>
                                    <th>Observaciones</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hists as $item)
                                <tr>
                                    <td class="py-1 px-2 text-center">{{ $h++ }}</td>
                                    <td class="py-1">{{ $item->fecha }}</td>
                                    <td class="py-1 px-2">{{ $item->remarks }}</td>
                                    <td class="py-1 px-2">
                                    <?php 
                                        switch ($item->status){
                                            case 0:
                                                echo '<span class="">Pendiente</span>';
                                                break;
                                            case 1:
                                                echo '<span class">Aprobado</span>';
                                                break;
                                            case 2:
                                                echo '<span class">Muestra Recogida</span>';
                                                break;
                                            case 3:
                                                echo '<span class="rounde">Entregado al laboratorio</span>';
                                                break;
                                            case 4:
                                                echo '<span class">Finalizado</span>';
                                                break;
                                            case 5:
                                                echo '<span class">Cancelado</span>';
                                                break;
                                            case 6:
                                                echo '<span class">Informe Subido</span>';
                                                break;
                                        }
                                    ?>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </fieldset>
                </div>
            </div>
        </div>
    </section>
</div>
@include('admin.citas.modal_estado')
@role('Cliente')
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
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cerrar</button>
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
@endrole
@endsection