<form class="form-horizontal" name="crearForm" id="crearForm" action="{{URL::asset('crear/vivienda')}}" method="POST">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div id="crearVivienda" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Nueva Vivienda</h4>
                </div>

                <div class="modal-body" style="margin: 2%;">
                    <div class="scroller">
                        <div class="row">
                            <div class="col-md-12">
                                <div class='form-group'>
                                    <label class='control-label col-sm-4' for='nombre'>* Nombre:</label>
                                    <div class='col-sm-8'>
                                        <input type='text' class='form-control' value='{{Input::old('nombre')}}' id='nombre' name='nombre'>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label class='control-label col-sm-4' for='direccion'>* Dirección:</label>
                                    <div class='col-sm-8'>
                                        <input type='text' class='form-control' value='{{Input::old('direccion')}}' id='direccion' name='direccion'>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label class='control-label col-sm-4' for='num_habitaciones'>* Número de habitaciones:</label>
                                    <div class='col-sm-2'>
                                        <select class="form-control" name="num_habitaciones" id="num_habitaciones">
                                            @for($i = 1; $i <= 10; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                            <option value="11">Más de 10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label class='control-label col-sm-4' for='num_banos'>* Número de baños:</label>
                                    <div class='col-sm-2'>
                                        <select class="form-control" name="num_banos" id="num_banos">
                                            @for($i = 1; $i <= 5; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                            <option value="6">Más de 5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label class='control-label col-sm-4' for='capacidad'>* Capacidad:</label>
                                    <div class='col-sm-2'>
                                        <input type='number' min="1" class='form-control' value='{{Input::old('capacidad')}}' id='capacidad' name='capacidad'>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label class='control-label col-sm-4' for='precio_persona'>Precio por persona:</label>
                                    <div class='col-sm-2'>
                                        <input type='number' min="0" step="0.1" class='form-control' value='{{Input::old('precio_persona')}}' id='precio_persona' name='precio_persona'>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label class='control-label col-sm-4' for='precio_total'>Precio total:</label>
                                    <div class='col-sm-2'>
                                        <input type='number' min="0" step="0.1" class='form-control' value='{{Input::old('precio_total')}}' id='precio_total' name='precio_total'>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label class='control-label col-sm-4' for='descripcion'>* Descripción:</label>
                                    <div class='col-sm-8'>
                                        <textarea class='form-control' id='descripcion' name='descripcion' rows='7'>{{Input::old('descripcion')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Cerrar</button>
                </div>

            </div>
        </div>

    </div>
</form>
