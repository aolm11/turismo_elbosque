{{ Form::open(array('route' => 'route.name', 'method' => 'POST')) }}
	<ul>
		<li>
			{{ Form::label('id_vivienda', 'Id_vivienda:') }}
			{{ Form::text('id_vivienda') }}
		</li>
		<li>
			{{ Form::label('nombre', 'Nombre:') }}
			{{ Form::textarea('nombre') }}
		</li>
		<li>
			{{ Form::submit() }}
		</li>
	</ul>
{{ Form::close() }}