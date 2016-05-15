@extends('template')
@section('title', 'Propietario')
@section('alertas')
	@if( $errors->has('nombre') )
		<div class="message">
			<div style="padding: 5px;">
				<div id="inner-message" class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					@foreach($errors->get('nombre') as $error )
						* {{ $error }}<br>
					@endforeach
				</div>
			</div>
		</div>
	@endif

	@if( $errors->has('direccion') )
		<div class="message">
			<div style="padding: 5px;">
				<div id="inner-message" class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					@foreach($errors->get('direccion') as $error )
						* {{ $error }}<br>
					@endforeach
				</div>
			</div>
		</div>
	@endif
	@if( $errors->has('num_habitaciones') )
		<div class="message">
			<div style="padding: 5px;">
				<div id="inner-message" class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					@foreach($errors->get('num_habitaciones') as $error )
						* {{ $error }}<br>
					@endforeach
				</div>
			</div>
		</div>
	@endif
	@if( $errors->has('num_banos') )
		<div class="message">
			<div style="padding: 5px;">
				<div id="inner-message" class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					@foreach($errors->get('num_banos') as $error )
						* {{ $error }}<br>
					@endforeach
				</div>
			</div>
		</div>
	@endif
	@if( $errors->has('capacidad') )
		<div class="message">
			<div style="padding: 5px;">
				<div id="inner-message" class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					@foreach($errors->get('capacidad') as $error )
						* {{ $error }}<br>
					@endforeach
				</div>
			</div>
		</div>
	@endif
	@if( $errors->has('descripcion') )
		<div class="message">
			<div style="padding: 5px;">
				<div id="inner-message" class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					@foreach($errors->get('descripcion') as $error )
						* {{ $error }}<br>
					@endforeach
				</div>
			</div>
		</div>
	@endif
@stop
@section('content')
	<div class="page-bar row content">
		<ul class="page-breadcrumb">
			<li>
				<i class="fa fa-home" aria-hidden="true"></i>
				<a href="{{URL::asset('')}}">Inicio</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<span>Propietario</span>
			</li>
		</ul>
	</div>
	<div class="row content">
		<div class="col-md-8 col-sm-8">
			<div class="section-title">
				<h1 class="titulo">Mis Viviendas</h1>
				<a class="btn btn-default derecha" data-toggle="modal" href="#crearVivienda" data-target="#crearVivienda">
					<i class="fa fa-plus" aria-hidden="true"></i>
					<i class="fa fa-home" aria-hidden="true"></i> Añadir
				</a>
			</div>
			@if(count($viviendas) != 0)
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Dirección</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
					@foreach($viviendas as $vivienda)
						<tr>
							<td>{{$vivienda->nombre}}</td>
							<td>{{$vivienda->direccion}}</td>
							<td>
								<a href="{{URL::asset('vivienda/edicion/'.$vivienda->id)}}" class="btn btn-default" role="button">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
								</a>
								<a href="{{'#modalConfirm'.$vivienda->id}}" class="btn btn-default" role="button" data-toggle="modal">
									<i class="fa fa-trash" aria-hidden="true"></i> Eliminar
								</a>
								<a href="#" class="btn btn-default" role="button">
									<i class="fa fa-picture-o" aria-hidden="true"></i> Añadir imágenes
								</a>
							</td>
						</tr>
						@include('modales.confirmar')
					@endforeach
					</tbody>
				</table>
			@else
				<div class="col-md-9 col-xs-12 text-center font-grey-mint">

					<h3 style="margin-top: 10%">Aún no ha añadido viviendas a la plataforma</h3>
				</div>
			@endif
		</div>
	</div>
	<br>
	<br>
	<div class="row content">
		<div class="col-md-12 col-sm-12">
			<div class="section-title">
				<h1 class="titulo">Notificaciones</h1>
			</div>

			@if(count($reservas) != 0)
				<table class="table table-bordered table-hover">
					<thead>
					<tr>
						<th>Vivienda</th>
						<th>Fecha Inicio</th>
						<th>Fecha Fin</th>
						<th>Mensaje</th>
						<th>Acciones</th>
					</tr>
					</thead>
					<tbody>
					@foreach($reservas as $reserva)
						<tr>
							<td>{{Vivienda::find($reserva->id_vivienda)->nombre}}</td>
							<td>{{Herramientas::formatearFechaBD($reserva->fecha_inicio)}}</td>
							<td>{{Herramientas::formatearFechaBD($reserva->fecha_fin)}}</td>
							<td>{{$reserva->mensaje}}</td>
							<td>
								<a href="#" class="btn btn-info" role="button">
									<i class="fa fa-check-square-o" aria-hidden="true"></i> Reservar
								</a>
								<a href="#" class="btn btn-danger" role="button">
									<i class="fa fa-ban" aria-hidden="true"></i> Cancelar
								</a>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			@else
				<div class="col-md-9 col-xs-12 text-center">

					<h3 style="margin-top: 6%">No tiene ninguna reserva en sus viviendas.</h3>
				</div>
			@endif
		</div>
	</div>
	<br>
	<br>
	<div class="row">
		<div class="content" style="padding-bottom: 1%; margin: 5px 40px;">
			<div class="section-title">
				<h1 class="titulo">Gestión de alquileres</h1>
			</div>
		</div>
	</div>
	<div class="row" style="margin:5px 25px;
">
		<div class="col-md-3 col-sm-3 content-panel">
			<div class="section-title-panel" style="margin-bottom: 5%">
				<h4>Añadir reserva</h4>
			</div>

			<form role="form">
				<div class="form-group">
					<label for="nombre">Nombre cliente:</label>
					<input type="text" class="form-control" id="nombre">
				</div>
				<div class="form-group">
					<label for="email">E-mail:</label>
					<input type="email" class="form-control" id="email">
				</div>
				<div class="form-group">
					<label for="telefono">Teléfono:</label>
					<input type="text" class="form-control" id="telefono">
				</div>
				<div class="form-group">
					<label for="vivienda">Vivienda:</label>
					<select class="form-control" name="vivienda" id="vivienda">
						@if(count($viviendas) > 0)
							@foreach($viviendas as $vivienda)
								<option value="{{$vivienda->id}}">{{$vivienda->nombre}}</option>
							@endforeach
						@else
							<option value="">No tiene viviendas añadidas</option>
						@endif
					</select>
				</div>
				<div class="row">
					<div class="col-md-6 col-xs-12">
						<div class="form-group">
							<label for="entrada">Entrada:</label>
							<div class='input-group date' >
								<input type="text" class="form-control" id='datepicker' name="entrada">
								<span class="input-group-addon">
									<i class="fa fa-calendar" aria-hidden="true"></i>
								</span>
							</div>

						</div>
					</div>
					<div class="col-md-6 col-xs-12">
						<div class="form-group">
							<label for="salida">Salida:</label>
							<div class='input-group date' >
								<input type="text" class="form-control" id='datepicker' name="salida">
								<span class="input-group-addon">
									<i class="fa fa-calendar" aria-hidden="true"></i>
								</span>
							</div>

						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-default">Guardar</button>
			</form>
		</div>
		<div class="col-md-8 col-sm-8 col-md-offset-1 content-panel">
			<div class="section-title-panel">
				<h4>Reservas</h4>
			</div>
			<div id="calendar"></div>
		</div>
	</div>
@include('modales.nuevaVivienda')

	<script>
		$(function() {
			$( "#datepicker" ).datepicker();
		});

		$(function () {
			$('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				},
				buttonText: {
					today: 'Hoy',
					month: 'Mes',
					week: 'Semana',
					day: 'Día'
				}
			});
		});
	</script>
@stop



