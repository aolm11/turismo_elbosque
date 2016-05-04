@extends('template')
@section('title', 'Admin')

@section('content')
	<div class="row content">
		<div class="col-md-12 col-sm-12">
			<div class="section-title">
				<h1 class="titulo">Propietarios</h1>
				<a class="btn btn-default derecha" data-toggle="modal" href="#crearPropietario" data-target="#crearPropietario">
					<i class="fa fa-user-plus" aria-hidden="true"></i> Añadir
				</a>
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
								<a href="#" class="btn btn-default" role="button">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
								</a>
								<a href="#" class="btn btn-danger" role="button" data-toggle="modal" data-target="{{'#modalConfirm'.$propietario->id}}">
									<i class="fa fa-trash" aria-hidden="true"></i> Eliminar
								</a>
							</td>
						</tr>
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
@include('modales.nuevoPropietario')
@stop
