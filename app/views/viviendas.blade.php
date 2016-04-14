{{ Form::open(array('route' => 'route.name', 'method' => 'POST')) }}
	<ul>
		<li>
			{{ Form::label('id_usuario', 'Id_usuario:') }}
			{{ Form::text('id_usuario') }}
		</li>
		<li>
			{{ Form::label('num_habitaciones', 'Num_habitaciones:') }}
			{{ Form::text('num_habitaciones') }}
		</li>
		<li>
			{{ Form::label('num_banos', 'Num_banos:') }}
			{{ Form::text('num_banos') }}
		</li>
		<li>
			{{ Form::label('capacidad', 'Capacidad:') }}
			{{ Form::text('capacidad') }}
		</li>
		<li>
			{{ Form::label('precio_persona', 'Precio_persona:') }}
			{{ Form::text('precio_persona') }}
		</li>
		<li>
			{{ Form::label('precio_total', 'Precio_total:') }}
			{{ Form::text('precio_total') }}
		</li>
		<li>
			{{ Form::label('descripcion', 'Descripcion:') }}
			{{ Form::textarea('descripcion') }}
		</li>
		<li>
			{{ Form::label('estado', 'Estado:') }}
			{{ Form::text('estado') }}
		</li>
		<li>
			{{ Form::submit() }}
		</li>
	</ul>
{{ Form::close() }}