
<div class="modal fade" id="modal_create_pacientes">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Registrar Paciente</h4>
        </div>
        <form method="POST" action="{{ route('admin.create.client') }}">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-4">
                        <input type="text" name="name" id="name" placeholder="Nombre" autofocus required class="form-control form-control-sm form-control-border @error('name') is-invalid @enderror">
                        <small class="mx-2">Nombres</small>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" name="apellido_pa" id="apellido_pa" placeholder="Primer Apellido" class="form-control form-control-sm form-control-border @error('apellido_pa') is-invalid @enderror">
                        <small class="mx-2">Primer Apellido</small>
                        @error('apellido_pa')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" name="apellido_ma" id="apellido_ma" placeholder="Segundo Apellido (Opcional)" class="form-control form-control-sm form-control-border @error('apellido_ma') is-invalid @enderror">
                        <small class="mx-2">Segundo Apellido</small>
                        @error('apellido_ma')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <input type="text" name="ci" id="ci" placeholder="" required class="form-control form-control-sm form-control-border @error('ci') is-invalid @enderror">
                        <small class="mx-2">Cedula de Itentidad</small>
                        @error('ci')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <select name="gender" id="gender" class="form-control form-control-sm form-control-border @error('gender') is-invalid @enderror" required>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                        <small class="mx-2">Sexo</small>
                        @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <input type="date" name="dob" id="dob" placeholder="(opcional)" required class="form-control form-control-sm form-control-border @error('dob') is-invalid @enderror">
                        <small class="mx-2">Fecha de Nacimiento</small>
                        @error('dob')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" name="contact" id="contact" placeholder="" required class="form-control form-control-sm form-control-border @error('contact') is-invalid @enderror">
                        <small class="mx-2">Teléfono</small>
                        @error('contact')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <input name="address" id="address" rows="3" class="form-control form-control-sm rounded-0 @error('address') is-invalid @enderror">
                        <small class="mx-2">Dirección</small>
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <input type="email" name="email" id="email" placeholder="correo" required class="form-control form-control-sm form-control-border @error('email') is-invalid @enderror">
                        <small class="mx-2">Correo</small>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <input id="password" type="password" class="form-control form-control-sm form-control-border @error('password') is-invalid @enderror" name="password" required>
                        <small class="mx-2">Contraseña</small>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <input id="password-confirm" type="password" class="form-control form-control-sm form-control-border" name="password_confirmation" required>
                        <small class="mx-2">Confirma Contraseña</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </form>
      </div>
    </div>
</div>