@extends('template')
@section('title', 'Detalles Reserva')
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
                <a href="{{URL::asset('propietario')}}">Propietario</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>Detalles reserva</span>
            </li>
        </ul>
    </div>
    <div class="row content">
        <div class="section-title-panel">
            <h3>Detalles Reserva</h3>
        </div>
        <form role="form" class="form-horizontal" name="editarReserva" id="editarReserva" method="POST" action="{{URL::asset('reserva/editar/'.$reserva->id)}}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="col-md-5 col-sm-5">
            <div class='form-group'>
                <label class='control-label col-sm-2' for='nombre'>Nombre:</label>
                <div class='col-sm-8'>
                    <input type='text' class='form-control' value='{{$cliente->nombre}}' id='nombre' name='nombre'>
                </div>
            </div>
            <div class='form-group'>
                <label class='control-label col-sm-2' for='telefono'>Teléfono:</label>
                <div class='col-sm-8'>
                    <input type='text' class='form-control' value='{{$cliente->telefono}}' id='telefono' name='telefono'>
                </div>
            </div>
            <div class='form-group'>
                <label class='control-label col-sm-2' for='email'>E-mail:</label>
                <div class='col-sm-8'>
                    <input type='text' class='form-control' value='{{$cliente->email}}' id='email' name='email'>
                </div>
            </div>
        </div>
        <div class="col-md-1 col-sm-1"></div>
        <div class="col-md-6 col-sm-6">

            <div class='form-group'>
                <label class='control-label' for='vivienda'>Vivienda:</label>
                <select class="form-control" name="vivienda" id="vivienda" style="width: 91%">
                    @if(count($viviendasPropietario) > 0)
                        @foreach($viviendasPropietario as $viviendaProp)
                            @if($vivienda->nombre == $viviendaProp->nombre)
                                <option value="{{$vivienda->id}}" selected>{{$vivienda->nombre}}</option>
                            @else
                                <option value="{{$viviendaProp->id}}">{{$viviendaProp->nombre}}</option>
                            @endif
                        @endforeach
                    @else
                        <option value="">No tiene viviendas añadidas</option>
                    @endif
                </select>
            </div>
            <div class="row">
                <div class="col-md-5 col-xs-12">
                    <div class="form-group">
                        <label for="entrada">Entrada:</label>
                        <div class='input-group date' >
                            <input type="text" class="form-control" id='entrada' name="entrada" value="{{Herramientas::formatearFechaFromBD($reserva->fecha_inicio)}}">
								<span class="input-group-addon">
									<i class="fa fa-calendar" aria-hidden="true"></i>
								</span>
                        </div>

                    </div>
                </div>
                <div class="col-md-1 col-xs-12"></div>
                <div class="col-md-5 col-xs-12">
                    <div class="form-group">
                        <label for="salida">Salida:</label>
                        <div class='input-group date' >
                            <input type="text" class="form-control" id='salida' name="salida" value="{{Herramientas::formatearFechaFromBD($reserva->fecha_fin)}}">
								<span class="input-group-addon">
									<i class="fa fa-calendar" aria-hidden="true"></i>
								</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-sm-12">
            <div class='form-group'>
                <label class='control-label col-sm-2' for='mensaje'>Mensaje:</label>
                <div class='col-sm-9'>
                    <textarea class='form-control' id='mensaje' name='mensaje' rows='10'>{{(is_null($reserva->mensaje)) ? 'No hay mensaje' : $reserva->mensaje}}</textarea>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class='form-group'>
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{URL::asset('eliminar/reserva/'.$reserva->id)}}" id="eliminar" class="btn btn-danger"><i class="fa fa-trash-o"></i> Anular</a>
                <a href="{{URL::to('propietario')}}" id="volver" class="btn btn-default"> Volver</a>

            </div>
        </div>
        </form>
    </div>
    <script>
        $(function() {
            var fechas = {{json_encode($reservasVivienda)}};

            crearDatePickers(fechas);
            actualizaMinDateSalidas(fechas);
            var id_reserva = '{{$reserva->id}}';
            $("#vivienda").change(function () {
                $.ajax({
                    method: 'GET',
                    url: window.location.pathname + '/../../../reservas/vivienda/'+$(this).val(),
                    data: {_token: $('#_token').val(), id: $(this).val(), id_reserva:id_reserva},
                    success: function (data) {

                        $('#entrada').datepicker("destroy");
                        $('#entrada').val('');
                        $('#salida').datepicker("destroy");
                        $('#salida').val('');
                        if ($('#vivienda').val() != '') {
                             crearDatePickers(data);
                            actualizaMinDateSalidas(data);
                        }
                        //$("#vivienda").trigger('change');

                    },
                    error: function (datas) {
                        alert('error');
                    }
                })

            });
        });
    </script>
@stop
