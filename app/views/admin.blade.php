@extends('template')
@section('title', 'Admin')
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

@if( $errors->has('apellidos') )
	<div class="message">
		<div style="padding: 5px;">
			<div id="inner-message" class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				@foreach($errors->get('apellidos') as $error )
					* {{ $error }}<br>
				@endforeach
			</div>
		</div>
	</div>
@endif
@if( $errors->has('telefono') )
	<div class="message">
		<div style="padding: 5px;">
			<div id="inner-message" class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				@foreach($errors->get('telefono') as $error )
					* {{ $error }}<br>
				@endforeach
			</div>
		</div>
	</div>
@endif
@if( $errors->has('email') )
	<div class="message">
		<div style="padding: 5px;">
			<div id="inner-message" class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				@foreach($errors->get('email') as $error )
					* {{ $error }}<br>
				@endforeach
			</div>
		</div>
	</div>
@endif
@if( $errors->has('password') )
	<div class="message">
		<div style="padding: 5px;">
			<div id="inner-message" class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				@foreach($errors->get('password') as $error )
					* {{ $error }}<br>
				@endforeach
			</div>
		</div>
	</div>
@endif
@stop
@section('content')
	<div class="row content">
		<div class="col-md-12 col-sm-12">
			<div class="section-title">
				<h1 class="titulo">Propietarios</h1>
				<a class="btn btn-default derecha" data-toggle="modal" href="#crearPropietario" data-target="#crearPropietario">
					<i class="fa fa-user-plus" aria-hidden="true"></i> Añadir
				</a>
			@include('modales.propietarioCrearEditar')
			</div>

		@if(count($propietarios) != 0)
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>E-Mail</th>
							<th>Viviendas</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
					@foreach($propietarios as $propietario)
						<tr>
							<td>{{$propietario->nombre.' '.$propietario->apellidos}}</td>
							<td>{{$propietario->email}}</td>
							<td>{{count(Vivienda::viviendasPropietario($propietario->id))}}</td>
							<td>
								<a href="{{'#editarPropietario'.$propietario->id}}" class="btn btn-default" role="button" data-toggle="modal">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
								</a>
								<a href="#" class="btn btn-danger" role="button" data-toggle="modal" data-target="{{'#modalConfirm'.$propietario->id}}">
									<i class="fa fa-trash" aria-hidden="true"></i> Eliminar
								</a>
							</td>
						</tr>
						@include('modales.propietarioCrearEditar')
						@include('modales.confirmar')
					@endforeach
					</tbody>
				</table>
			@else
				<div class="col-md-9 col-xs-12 text-center font-grey-mint">

					<h3 style="margin-top: 20%">Aún no existen propietarios en la plataforma</h3>
				</div>
			@endif
		</div>
	</div>
@stop
