{{ Form::open(array('route' => 'route.name', 'method' => 'POST')) }}
	<ul>
		<li>
			{{ Form::label('id_vivienda', 'Id_vivienda:') }}
			{{ Form::text('id_vivienda') }}
		</li>
		<li>
			{{ Form::label('id_cliente', 'Id_cliente:') }}
			{{ Form::text('id_cliente') }}
		</li>
		<li>
			{{ Form::label('fecha_inicio', 'Fecha_inicio:') }}
			{{ Form::text('fecha_inicio') }}
		</li>
		<li>
			{{ Form::label('fecha_fin', 'Fecha_fin:') }}
			{{ Form::text('fecha_fin') }}
		</li>
		<li>
			{{ Form::submit() }}
		</li>
	</ul>
{{ Form::close() }}