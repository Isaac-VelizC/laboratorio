<div class="modal fade" id="modal_show_paciente{{$item->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmación</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <img src="{{ $item->user->avatar ? asset('storage/'.$item->user->avatar) : asset('imgs/'. ($item->gender === 'Masculino' ? 2 : 1) .'.jpg') }}" alt="Imagen de Cliente" class="img-circle border bg-gradient-dark" height="200" width="200">
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col-md-12">
                            <dl>
                                <dt class="text-muted">Nombre</dt>
                                <dd class='pl-4 fs-4 fw-bold'>{{ isset($item->user->nombres) ? $item->user->nombres . ' '. $item->user->apellido_pa. ' '. $item->user->apellido_ma : 'N/A'}}</dd>
                                <dt class="text-muted">Sexo</dt>
                                <dd class='pl-4 fs-4 fw-bold'>{{ isset($item->gender) ? $item->gender : 'N/A'}}</dd>
                                <dt class="text-muted">Fecha de Nacimiento</dt>
                                <dd class='pl-4 fs-4 fw-bold'>{{ isset($item->dob) ? $item->dob : 'N/A'}}</dd>
                                <dt class="text-muted">Teléfono</dt>
                                <dd class='pl-4 fs-4 fw-bold'>{{ isset($item->contact ) ? $item->contact  : 'N/A'}}</dd>
                                <dt class="text-muted">Correo</dt>
                                <dd class='pl-4 fs-4 fw-bold'>{{ isset($item->user->email) ? $item->user->email : 'N/A'}}</dd>
                                <dt class="text-muted">Dirección</dt>
                                <dd class='pl-4 fs-4 fw-bold'>{{ isset($item->address) ? $item->address : 'N/A'}}</dd>
                            </dl>
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-flat btn-dark btn-sm" type="button" data-bs-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>