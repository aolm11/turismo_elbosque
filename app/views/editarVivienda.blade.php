@extends('template')
@section('title', 'Editar Vivienda')

@section('content')
    <div class="row">
        <div class="col-md-5 col-sm-5 content-panel">
            <div class="section-title-panel">
                <h3>Detalles Vivienda</h3>
            </div>
            <form role="form" class="form-horizontal" name="crearVivienda" id="crearVivienda" method="POST" action="{{URL::asset('vivienda/editar/'.$vivienda->id)}}">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class='form-group'>
                    <label class='control-label col-sm-3' for='nombre'>Nombre:</label>
                    <div class='col-sm-5'>
                        <input type='text' class='form-control' value='{{$vivienda->nombre}}' id='nombre' name='nombre'>
                    </div>
                </div>
                <div class='form-group'>
                    <label class='control-label col-sm-3' for='direccion'>Dirección:</label>
                    <div class='col-sm-5'>
                        <input type='text' class='form-control' value='{{$vivienda->direccion}}' id='direccion' name='direccion'>
                    </div>
                </div>
                <div class='form-group'>
                    <label class='control-label col-sm-3' for='num_habitaciones'>Número de habitaciones:</label>
                    <div class='col-sm-2'>
                        <select class="form-control" name="num_habitaciones" id="num_habitaciones">
                        @for($i = 1; $i <= 10; $i++)
                            @if($vivienda->num_habitaciones == $i)
                                <option value="{{$i}}" selected>{{$i}}</option>
                            @else
                                <option value="{{$i}}">{{$i}}</option>
                            @endif
                        @endfor
                            <option value="11">Más de 10</option>
                        </select>
                    </div>
                </div>
                <div class='form-group'>
                    <label class='control-label col-sm-3' for='num_banos'>Número de baños:</label>
                    <div class='col-sm-2'>
                        <select class="form-control" name="num_banos" id="num_banos">
                            @for($i = 1; $i <= 5; $i++)
                                @if($vivienda->num_banos == $i)
                                    <option value="{{$i}}" selected>{{$i}}</option>
                                @else
                                    <option value="{{$i}}">{{$i}}</option>
                                @endif
                            @endfor
                                <option value="6">Más de 5</option>
                        </select>
                    </div>
                </div>
                <div class='form-group'>
                    <label class='control-label col-sm-3' for='capacidad'>Capacidad:</label>
                    <div class='col-sm-2'>
                        <input type='number' min="1" class='form-control' value='{{$vivienda->capacidad}}' id='capacidad' name='capacidad'>
                    </div>
                </div>
                <div class='form-group'>
                    <label class='control-label col-sm-3' for='precio_persona'>Precio por persona:</label>
                    <div class='col-sm-2'>
                        <input type='number' min="0" step="0.1" class='form-control' value='@if(!is_null($vivienda->precio_persona)){{$vivienda->precio_persona}}@endif' id='precio_persona' name='precio_persona'>
                    </div>
                </div>
                <div class='form-group'>
                    <label class='control-label col-sm-3' for='precio_total'>Precio total:</label>
                    <div class='col-sm-2'>
                        <input type='number' min="0" step="0.1" class='form-control' value='@if(!is_null($vivienda->precio_total)){{$vivienda->precio_total}}@endif' id='precio_total' name='precio_total'>
                    </div>
                </div>
                <div class='form-group'>
                    <label class='control-label col-sm-3' for='descripcion'>Descripción:</label>
                    <div class='col-sm-7'>
                        <textarea class='form-control' id='descripcion' name='descripcion' rows='7'>{{$vivienda->descripcion}}</textarea>
                    </div>
                </div>
                <div class='form-group'>
                    <div class='col-sm-3 col-sm-offset-3'>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-6 col-sm-6 col-md-offset-1 content-panel">
            <form role="form" name="addImagen" id="addImagen" method="POST" enctype="multipart/form-data" action="{{URL::asset('add/imagen/'.$vivienda->id)}}">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="section-title-panel">
                    <h3>Imágenes</h3>
                </div>
                <label class="control-label">Añadir imagen</label>

                <div class="form-group">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail"
                             style="width: 200px; height: 150px;">
                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=sin+imagen"
                                 alt=""/></div>
                        <div class="fileinput-preview fileinput-exists thumbnail"
                             style="max-width: 200px; max-height: 150px;"></div>
                        <div>
                        <span class="btn btn-info btn-file">
                            <span class="fileinput-new"> Seleccionar Imagen </span>
                            <span class="fileinput-exists"> Cambiar </span>
                            <input id="imagen" type="file" name="imagen"> </span>
                            <button class="btn btn-success fileinput-exists" type="submit">Añadir</button>
                            <a href="javascript:;"
                               class="btn btn-danger fileinput-exists"
                               data-dismiss="fileinput"> Borrar </a>
                        </div>
                    </div>
                </div>
            </form>
            @if(isset($imagenes) and count($imagenes) != 0)
                <div class="form-group">
                    <div class="file-input">
                            <div class="file-preview">
                                <div class="file-drop-zone">
                                @foreach($imagenes as $imagen)
                                    <div class="file-preview-frame">
                                        <img height="12%" width="8%" src="{{URL::asset('img/viviendas/'.$imagen->nombre)}}" class="img-responsive" alt="">
                                        <div class="file-thumbnail-footer">
                                            <div class="file-footer-caption" title="{{$imagen->nombre}}">{{$imagen->nombre}}</div>
                                            <div class="file-actions">
                                                <div class="file-footer-buttons">
                                                    <a href="#" title="Eliminar">
                                                        <i class="fa fa-trash-o text-danger" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                    </div>
                </div>
            @endif

        </div>

    </div>
@stop