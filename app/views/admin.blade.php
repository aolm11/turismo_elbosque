@extends('template')
@section('title', 'Admin')
@include('notificaciones')
@section('content')
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<i class="fa fa-home" aria-hidden="true"></i>
				<a href="{{URL::asset('')}}">Inicio</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<span>Administrador</span>
			</li>
		</ul>
	</div>
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
								@if($propietario->alta == 1)
									<a href="{{URL::asset('propietario/baja/'.$propietario->id)}}" class="btn btn-danger" role="button">
										<i class="fa fa-user-times" aria-hidden="true"></i> Dar de baja
									</a>
								@else
									<a href="{{URL::asset('propietario/alta/'.$propietario->id)}}" class="btn btn-success" role="button">
										<i class="fa fa-sign-in" aria-hidden="true"></i> Dar de alta
									</a>
									<a href="#" class="btn btn-danger" role="button" data-toggle="modal" data-target="{{'#modalConfirm'.$propietario->id}}">
										<i class="fa fa-trash" aria-hidden="true"></i> Eliminar
									</a>
								@endif
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
