@extends('template')
@section('title', 'Editar Vivienda')

@section('content')
    <div class="page-bar row content">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home" aria-hidden="true"></i>
                <a href="{{URL::asset('')}}">Inicio</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{URL::asset('propietario')}}">Propietario</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>Editar vivienda</span>
            </li>
        </ul>
    </div>
    <div class="row content">
        <div class="section-title-panel">
            <h3>Detalles Vivienda</h3>
        </div>
        <form role="form" class="form-horizontal" name="crearVivienda" id="crearVivienda" method="POST" action="{{URL::asset('vivienda/editar/'.$vivienda->id)}}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="col-md-5 col-sm-5">
            <div class='form-group'>
                <label class='control-label col-sm-4' for='nombre'>Nombre:</label>
                <div class='col-sm-8'>
                    <input type='text' class='form-control' value='{{$vivienda->nombre}}' id='nombre' name='nombre'>
                </div>
            </div>
            <div class='form-group'>
                <label class='control-label col-sm-4' for='direccion'>Dirección:</label>
                <div class='col-sm-8'>
                    <input type='text' class='form-control' value='{{$vivienda->direccion}}' id='direccion' name='direccion'>
                </div>
            </div>
            <div class='form-group'>
                <label class='control-label col-sm-4' for='num_habitaciones'>Número de habitaciones:</label>
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
                <label class='control-label col-sm-4' for='num_banos'>Número de baños:</label>
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
        </div>
        <div class="col-md-1 col-sm-1"></div>
        <div class="col-md-6 col-sm-6">

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
                <div class='col-sm-9'>
                    <textarea class='form-control' id='descripcion' name='descripcion' rows='10'>{{$vivienda->descripcion}}</textarea>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class='form-group'>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </div>
        </form>
    </div>
    <br>
    <br>
    <div class="row content">

        <div class="col-md-12 col-sm-12">
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
                    <div class="section-title-panel">
                        <h3>Imágenes subidas</h3>
                    </div>
                    <div class="row">
                        @foreach($imagenes as $imagen)
                            <?php $nombre = explode('.jpg', $imagen->nombre); ?>
                            <div class="col-lg-3 col-sm-4 col-6" style="max-width:150px; max-height:120px;"><a href="#" data-id="{{$imagen->id}}" title="{{$nombre[0]}}"><img src="{{URL::asset('img/viviendas/'.$imagen->nombre)}}" class="thumbnail img-responsive"></a></div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        $('.thumbnail').click(function(){
            var id = $(this).parent().data('id');
            //alert(id);
            $('.modal-body').empty();
            var title = $(this).parent('a').attr("title");
            $('.modal-title').html(title);
            $($(this).parents('div').html()).appendTo('.modal-body');
            $("#modalImg input.my_hidden_field").val(id);
            var url = '{{URL::asset('eliminar/imagen/')}}/'+id;
            $("#eliminar").attr("href", url);
            $('#modalImg').modal({show:true});
        });
    </script>
@include('modales.imagen')
@stop
