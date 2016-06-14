@extends('template')
@section('title', 'Detalles de la vivienda')
@include('notificaciones')
@section('content')
    <div class="page-bar row content">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home" aria-hidden="true"></i>
                <a href="{{URL::asset('')}}">Inicio</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{URL::asset('viviendas')}}">Viviendas</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>Detalles vivienda</span>
            </li>
        </ul>
    </div>
    <div class="row content">
        <div class="section-title-panel">
            <h3>{{$vivienda->nombre}}</h3>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="section-title-panel" style="margin-bottom: 5%">
                    <h4>Disponibilidad</h4>
                </div>
                <div id="disponibilidad"></div>

            </div>
            <div class="col-md-7">
                <div class="row carousel-holder">

                    <div class="col-md-12">
                        @if(count($imagenes) > 0)
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <?php $cont = 0 ?>
                                    @foreach($imagenes as $imagen)
                                        <li data-target="#carousel-example-generic" data-slide-to="{{$cont}}"></li>
                                        <?php $cont++ ?>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    @foreach($imagenes as $imagen)
                                        @if($imagenes[0] == $imagen)
                                            <div class="item active">
                                                <img class="slide-image" src="{{URL::asset('img/viviendas/'.$imagen->nombre)}}" alt="">
                                            </div>
                                        @else
                                            <div class="item">
                                                <img class="slide-image" src="{{URL::asset('img/viviendas/'.$imagen->nombre)}}" alt="">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>
                        @else
                            <div class="col-md-9 col-xs-12 text-center font-grey-mint">

                                <h3 style="margin-top: 10%">La vivienda aún no tiene imágenes.</h3>
                            </div>
                        @endif
                    </div>

                </div>
                <div>
                    <p class="pull-left">Valoración: </p>
                    <div class="ratings">
                        <p class="pull-left">
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                        </p>
                    </div>
                    <p class="pull-left">X Opiniones</p>
                    <p class="pull-right">
                        {{($vivienda->precio_dia != 0 and $vivienda->precio_persona != 0) ? 'Precio por día: '.$vivienda->precio_dia.' €' : ($vivienda->precio_dia != 0) ? 'Precio por día: '.$vivienda->precio_dia.' €' : 'Precio por persona: '.$vivienda->precio_persona.' €/día'}}
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="section-title-panel" style="margin-bottom: 5%">
                    <h4>Contacto</h4>
                </div>

                <form role="form" method="POST" action="{{URL::asset('enviar/reserva')}}">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="vivienda" id="vivienda" value="{{$vivienda->id}}">
                    <div class="form-group">
                        <label for="nombre">Nombre: *</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{Input::old('nombre')}}">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail: *</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{Input::old('email')}}">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono: *</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="{{Input::old('telefono')}}">
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="entrada">Entrada: *</label>
                                <div class='input-group date' >
                                    <input type="text" class="form-control" id='entrada' name="entrada" value="{{Input::old('entrada')}}">
								<span class="input-group-addon">
									<i class="fa fa-calendar" aria-hidden="true"></i>
								</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="salida">Salida: *</label>
                                <div class='input-group date' >
                                    <input type="text" class="form-control" id='salida' name="salida" value="{{Input::old('salida')}}">
								<span class="input-group-addon">
									<i class="fa fa-calendar" aria-hidden="true"></i>
								</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label for='mensaje'>Mensaje: *</label>
                        <textarea class='form-control' id='mensaje' name='mensaje' rows='10'>{{Input::old('mensaje')}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-info">Enviar</button>
                </form>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="row content">
        <div class="section-title-panel">
            <h3>Descripción</h3>
        </div>
        <p>{{$vivienda->descripcion}}</p>
    </div>
    <br>
    <br>
    <div class="row content">
        <div class="section-title-panel">
            <h3>Características</h3>
        </div>
        <div class="col-md-6">
            <p>- Dirección: {{$vivienda->direccion}}</p>
            <p>- Capacidad: {{$vivienda->capacidad}} personas</p>
            <p>- Habitaciones: {{$vivienda->num_habitaciones}}</p>
            <p>- Baños: {{$vivienda->num_banos}}</p>
        </div>
        <div class="col-md-6">
            <?php
                $dir = explode(' ', $vivienda->direccion);
                $url = "https://www.google.com/maps/embed/v1/place?key=AIzaSyDyu5SyeF7o-PJ9IfJun16eBTQEpLU3_e0&zoom=16&q=";
                foreach ($dir as $key => $parte) {
                    if($key != 0){
                        if($parte != end($dir)){
                            $url .= $parte.'+';
                        }else{
                            $url .= $parte;
                        }
                    }
                }
                $url .= "+el+bosque+cadiz";
            ?>
            <iframe
                    width="600"
                    height="350"
                    frameborder="0" style="border:0"
                    src="{{$url}}" allowfullscreen>
            </iframe>
        </div>
    </div>
    <br>
    <br>
    <div class="row content">
        <div class="section-title-panel">
            <h3>Valoraciones</h3>
        </div>
    </div>
    <script>
        var fechas = {{json_encode($reservas)}};

        if(fechas != null){
            $( "#disponibilidad" ).datepicker({
                dateFormat: 'dd-mm-yy',
                minDate: new Date(),
                beforeShowDay: function(date){
                    var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                    return [ fechas.indexOf(string) == -1 ]
                }
            });

            crearDatePickers(fechas);
            actualizaMinDateSalidas(fechas);
        }else{
            $( "#disponibilidad" ).datepicker({
                dateFormat: 'dd-mm-yy',
                minDate: new Date(),
            });

            $( "#entrada" ).datepicker({
                dateFormat: 'dd-mm-yy',
                minDate: new Date()
            });
            $( "#salida" ).datepicker({
                dateFormat: 'dd-mm-yy',
                minDate: new Date((new Date()).valueOf() + 1000*3600*24),
            });

            $("#entrada").change(function () {
                var select = $("#entrada").val();
                var result = select.split('-');
                var fecha = result[2]+'-'+result[1]+'-'+result[0];
                fecha = new Date(fecha);
                var man = fecha.setDate(fecha.getDate() + 1);
                man = new Date(man);
                $('#salida').datepicker("destroy");
                $( "#salida" ).datepicker({
                    dateFormat: 'dd-mm-yy',
                    minDate: man,
                });
            });

        }

    </script>
@stop
