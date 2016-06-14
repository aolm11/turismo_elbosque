@if(isset($propietario))
<form name="editarForm" id="editarForm" action="{{URL::asset('editar/propietario/'.$propietario->id)}}" method="POST">
@else
<form name="crearForm" id="crearForm" action="{{URL::asset('nuevo/propietario')}}" method="POST">
@endif
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div id="{{(isset($propietario)) ? 'editarPropietario'.$propietario->id: 'crearPropietario'}}" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">{{(isset($propietario)) ? 'Editar Propietario': 'Nuevo Propietario'}}</h4>
                </div>

                <div class="modal-body" style="margin: 2%;">
                    <div class="scroller">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label class="control-label" for="nombre">Nombre: *</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" value="{{(isset($propietario)) ? $propietario->nombre : Input::old('nombre')}}" maxlength="50" onblur="comprobarInput(this.id)">
                                    <small class="help-block" style="display: none;" id="nombreAyuda">El nombre es requerido</small>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="apellidos">Apellidos: *</label>
                                    <input type="text" class="form-control" name="apellidos" id="apellidos" value="{{(isset($propietario)) ? $propietario->apellidos : Input::old('apellidos')}}" maxlength="100" onblur="comprobarInput(this.id)">
                                    <small class="help-block" style="display: none;" id="apellidosAyuda">Los apellidos son requeridos</small>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="telefono">Teléfono: *</label>
                                    <input type="text" class="form-control" name="telefono" id="telefono" value="{{(isset($propietario)) ? $propietario->telefono : Input::old('telefono')}}" maxlength="9" onblur="comprobarInput(this.id)">
                                    <small class="help-block" style="display: none;" id="telefonoAyuda">El teléfono es requerido</small>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="email">E-mail: *</label>
                                    <input type="email" class="form-control" name="email" id="email" maxlength="50" value="{{(isset($propietario)) ? $propietario->email : Input::old('email')}}" onblur="comprobarInput(this.id)">
                                    <small class="help-block" style="display: none;" id="emailAyuda">El e-mail es requerido</small>
                                </div>
                                @if(!isset($propietario))
                                    <div class="form-group">
                                        <label class="control-label" for="password">Contraseña: *</label>
                                        <input type="password" class="form-control" name="password" id="password" maxlength="100" onblur="comprobarInput(this.id)">
                                        <small class="help-block" style="display: none;" id="passwordAyuda">La contraseña es requerida</small>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="password2">Repita Contraseña: *</label>
                                        <input type="password" class="form-control" name="password2" id="password2" maxlength="100" onblur="comprobarInput(this.id)">
                                        <small class="help-block" style="display: none;" id="password2Ayuda">Debe repetir la contraseña</small>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="permiso_app" id="permiso_app" {{(isset($propietario->permiso_app)) ? 'checked' : ""}}><strong>Permiso app:</strong></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <button type="button" data-dismiss="modal" class="btn btn-info">Cerrar</button>
                </div>

            </div>
        </div>

    </div>
</form>
