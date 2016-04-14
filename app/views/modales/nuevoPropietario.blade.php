<form name="crearForm" id="crearForm" action="{{URL::asset('area/crear')}}" method="POST">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div id="crearPropietario" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><i class="icon-layers"></i> Nuevo Propietario</h4>
                </div>

                <div class="modal-form" style="margin-left: 1.5%;">
                    <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label class="control-label" for="idNombreRegistro">Nombre:</label>
                                    <input type="text" class="form-control" name="nombreRegistro" id="idNombreRegistro" placeholder="Nombre" value="{{Input::old('nombreRegistro')}}" maxlength="50" onblur="comprobarInput(this.id)">
                                    <small class="help-block oculto" id="idNombreRegistroAyuda">El nombre es requerido</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn red btn-outline">Cerrar</button>
                    <button type="submit" class="btn green">Guardar</button>
                </div>

            </div>
        </div>

    </div>
</form>
