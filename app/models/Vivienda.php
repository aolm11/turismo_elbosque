<?php

class Vivienda extends Eloquent {

	protected $table = 'viviendas';
	protected $fillable = array('id', 'id_usuario', 'nombre','direccion', 'num_habitaciones', 'num_banos', 'capacidad', 'precio_persona', 'precio_dia', 'descripcion');
	public $timestamps = true;

	public function usuario()
	{
		return $this->belongsTo('Usuario');
	}

	public function imagen()
	{
		return $this->hasMany('Imagen');
	}

	public function alquiler()
	{
		return $this->hasMany('Alquiler');
	}

	/**
	 * Consulta para obtener todas las viviendas de un propietario.
	 */
	public static function viviendasPropietario($idPropietario){
		$viviendas = DB::table('viviendas')->where('id_usuario', '=', $idPropietario)->get();
		return $viviendas;
	}

	/**
	 * Consulta para obtener todas las viviendas de la plataforma, paginándolas mostrando 9 por cada página.
	 * Se usa para mostrar el listado general de viviendas.
	 */
	public static function getTodasViviendas(){
		$viviendas = DB::table('viviendas')
			->join('usuarios','viviendas.id_usuario', '=', 'usuarios.id')
			->where('usuarios.alta', '=', 1)
			->select('viviendas.id', 'viviendas.nombre', 'viviendas.capacidad','viviendas.descripcion', 'viviendas.precio_persona', 'viviendas.precio_dia')
			->paginate(9);
		return $viviendas;
	}


	/**
	 * Método que sirve para filtrar las viviendas desde el buscador de inicio.
	 */
	public static function buscarViviendas($input){
		$respuesta = array();

		$reglas = array(
			'entrada' => array('required', 'date_format:d-m-Y'),
			'salida' => array('required', 'date_format:d-m-Y')
		);

		$validator = Validator::make($input, $reglas);

		if ($validator->fails()) {
			$respuesta['mensaje'] = $validator;
			$respuesta['error'] = true;

			return $respuesta;
		} else {
			if(!empty($input['personas'])){
				$viviendas = DB::table('viviendas')
					->join('usuarios','viviendas.id_usuario', '=', 'usuarios.id')
					->where('usuarios.alta', '=', 1)
					->select('viviendas.id', 'viviendas.nombre', 'viviendas.capacidad','viviendas.descripcion', 'viviendas.precio_persona', 'viviendas.precio_dia')
					->where('capacidad', '>=', $input['personas'])->get();
			}else{
				$viviendas = DB::table('viviendas')
					->join('usuarios','viviendas.id_usuario', '=', 'usuarios.id')
					->where('usuarios.alta', '=', 1)
					->select('viviendas.id', 'viviendas.nombre', 'viviendas.capacidad','viviendas.descripcion', 'viviendas.precio_persona', 'viviendas.precio_dia')
					->get();
			}

			foreach ($viviendas as $key => $vivienda) {
				if(!Vivienda::viviendaDisponible($vivienda->id, $input['entrada'], $input['salida'])){
					unset($viviendas[$key]);
				}
			}

			return $viviendas;
		}
	}

	/*
	 * Método usado para crear viviendas.
	 */
	public static function crear($input){

		$respuesta = array();

		$reglas = array(
			'nombre' => array('required', 'min:3', 'max:100'),
			'direccion' => array('required', 'min:3', 'max:200'),
			'num_habitaciones' => array('required','integer',  'between:1,11'),
			'num_banos'=> array('required', 'integer', 'between:1,6'),
			'capacidad' => array('required', 'integer', 'min:1'),
			'descripcion' => array('required'),
		);
		if($input['precio_persona'] == "" and $input['precio_dia'] == ""){
			$reglas=array_add($reglas,'precio_dia',array('required'));;
		}

		$validator = Validator::make($input, $reglas);

		if ($validator->fails()) {
			$respuesta['mensaje'] = $validator;
			$respuesta['error'] = true;
		} else {

			$vivienda = new Vivienda();
			$vivienda->id_usuario = Auth::id();
			$vivienda->nombre = $input['nombre'];
			$vivienda->direccion = $input['direccion'];
			$vivienda->num_habitaciones = $input['num_habitaciones'];
			$vivienda->num_banos = $input['num_banos'];
			$vivienda->capacidad = $input['capacidad'];
			$vivienda->descripcion = $input['descripcion'];

			if(isset($input['precio_persona'])){
				$vivienda->precio_persona = $input['precio_persona'];
			}

			if(isset($input['precio_dia'])){
				$vivienda->precio_dia = $input['precio_dia'];
			}

			$vivienda->save();

			$respuesta['mensaje'] = 'Vivienda creada';
			$respuesta['error'] = false;
			$respuesta['data'] = $vivienda;
			$respuesta['exito'] = true;


		}
		return $respuesta;
	}

	/*
	 * Método usado para editar viviendas.
	 */
	public static function editar($id, $input){

		$respuesta = array();

		$reglas = array(
			'nombre' => array('required', 'min:3', 'max:100'),
			'direccion' => array('required', 'min:3', 'max:200'),
			'num_habitaciones' => array('required','integer',  'between:1,11'),
			'num_banos'=> array('required', 'integer', 'between:1,6'),
			'capacidad' => array('required', 'integer', 'min:1'),
			'descripcion' => array('required', 'alpha_num'),
		);

		if($input['precio_persona'] == "" and $input['precio_dia'] == ""){
			$reglas=array_add($reglas,'precio_dia',array('required'));;
		}

		$validator = Validator::make($input, $reglas);

		if ($validator->fails()) {
			$respuesta['mensaje'] = $validator;
			$respuesta['error'] = true;
		} else {

			$vivienda = Vivienda::find($id);
			$vivienda->nombre = $input['nombre'];
			$vivienda->direccion = $input['direccion'];
			$vivienda->num_habitaciones = $input['num_habitaciones'];
			$vivienda->num_banos = $input['num_banos'];
			$vivienda->capacidad = $input['capacidad'];
			$vivienda->descripcion = $input['descripcion'];

			if(isset($input['precio_persona'])){
				$vivienda->precio_persona = $input['precio_persona'];
			}

			if(isset($input['precio_dia'])){
				$vivienda->precio_dia = $input['precio_dia'];
			}

			$vivienda->save();

			$respuesta['mensaje'] = 'Vivienda editada';
			$respuesta['error'] = false;
			$respuesta['data'] = $vivienda;
			$respuesta['exito'] = true;


		}
		return $respuesta;
	}

	/*
	 * Método usado para añadir imágenes a una vivienda.
	 */
	public static function addImagen($id_vivienda, $input){

		$vivienda = Vivienda::find($id_vivienda);

		$respuesta = array();

		$reglas = array(
			'imagen' => array('required'),
		);

		$validator = Validator::make($input, $reglas);

		if ($validator->fails()) {
			$respuesta['mensaje'] = $validator;
			$respuesta['error'] = true;
		} else {

			if (!is_null($input['imagen'])) {
				$imagenarchivo = $input['imagen'];
				$nombreImagen = $vivienda->nombre.(count(Imagen::imagenesVivienda($id_vivienda))+1).".jpg";
				$directorio = public_path('img/viviendas');

				if (!file_exists($directorio)) {
					mkdir($directorio, 0777, true);
				}
				$path = $directorio . '/' . $nombreImagen;

				Image::make($imagenarchivo->getRealPath())->save($path);

				$imagen = new Imagen();
				$imagen->id_vivienda = $id_vivienda;
				$imagen->nombre = $nombreImagen;
				$imagen->save();

				$respuesta['mensaje'] = 'Imagen añadida';
				$respuesta['error'] = false;
				$respuesta['data'] = $vivienda;
				$respuesta['exito'] = true;


			}else{
				$respuesta['mensaje'] = 'No ha seleccionado ninguna imagen';
				$respuesta['error'] = false;
				$respuesta['data'] = null;
				$respuesta['exito'] = false;

			}
		}

		return $respuesta;
	}

	/**
	 * Método para eliminar viviendas, si no tienen reservas asociadas.
	 */
	public static function borrar($id_vivienda){

		$respuesta = array();

		$vivienda = Vivienda::find($id_vivienda);

		$reservas = Alquiler::reservasVivienda($id_vivienda);

		if(empty($reservas)){

			$imagenes = Imagen::imagenesVivienda($id_vivienda);

			if(!empty($imagenes)){

				foreach ($imagenes as $imagen) {
				Imagen::borrar($imagen->id);
				}
			}
			$vivienda->delete();

			$respuesta['mensaje'] = 'Vivienda eliminada';
			$respuesta['error'] = false;
			$respuesta['data'] = $vivienda;
			$respuesta['exito'] = true;
		}else{
			$respuesta['mensaje'] = 'No se ha podido eliminar la vivienda. Tiene reservas asociadas.';
			$respuesta['error'] = false;
			$respuesta['data'] = $vivienda;
			$respuesta['exito'] = false;

		}

		return $respuesta;

	}

	/**
	 * Método usado para obtener las fechas reservadas de una vivienda, con diferentes formatos según su uso.
	 * @param $id_vivienda
	 * @param bool|false $pickers. Devolverá todas las fechas en único array. Se usa para deshabilitar las fechas reservadas en los datepickers.
	 * 							   Si es false, devolverá una matriz con los los días de cada reserva.
	 * @param null $reserva_edic. Devolverá todas las fechas, sin incluir la fecha de la reserva, para poder ser editada.
	 * @return array|null
	 */
	public static function getTodasFechasReservadas($id_vivienda, $pickers = false, $reserva_edic = null){
		
		$reservas = Alquiler::reservasConfirmadas($id_vivienda);

		$alquileres = array();
		if(count($reservas) > 0){
			foreach ($reservas as $reserva) {
				$fechas = array();
				$dias = Alquiler::getDiasAlquilados($reserva->fecha_inicio,$reserva->fecha_fin);
				
				for($i = 0; $i<= $dias->d; $i++){
					if($pickers){
						if(is_null($reserva_edic)){
							array_push($alquileres, date('Y-m-d', strtotime($reserva->fecha_inicio. ' + '.$i.' days')));
						}else{
							if($reserva_edic->id != $reserva->id){
								array_push($alquileres, date('Y-m-d', strtotime($reserva->fecha_inicio. ' + '.$i.' days')));
							}
						}
					}else{
						if(is_null($reserva_edic)){
							array_push($fechas, date('d-m-Y', strtotime($reserva->fecha_inicio. ' + '.$i.' days')));
						}else{
							if($reserva_edic->id != $reserva->id){
								array_push($fechas, date('d-m-Y', strtotime($reserva->fecha_inicio. ' + '.$i.' days')));
							}
						}
					}
				}
				if(!$pickers){
					array_push($alquileres, $fechas);
				}
			}
		}else{
			$alquileres = null;
		}
		
		return $alquileres;
		
	}

	/**
	 * Método usado para comprobar la disponibilidad de una vivienda, en el periodo de tiempo indicado.
	 * @param $id_vivienda
	 * @param $fecha_inicio
	 * @param $fecha_fin
	 * @param null $reserva. Se usa en la edición de la reserva. Si no se han modificado las fechas devuelve true.
	 * 						 En caso contrario comprueba la coincidencia con el resto de reservas.
	 * @return bool
	 */
	public static function viviendaDisponible($id_vivienda, $fecha_inicio, $fecha_fin, $reserva = null){

		$disponible = true;

		$diasNuevaReserva = Alquiler::getDiasAlquilados($fecha_inicio,$fecha_fin);

		$alquileres = Vivienda::getTodasFechasReservadas($id_vivienda);

		if(!is_null($reserva)){
			if(Herramientas::formatearFechaBD($fecha_inicio) == $reserva->fecha_inicio and Herramientas::formatearFechaBD($fecha_fin) == $reserva->fecha_fin){
				return true;
			}else{
				$alquileres = Vivienda::getTodasFechasReservadas($id_vivienda, false,$reserva);
			}

		}

		if(!is_null($alquileres)){
			foreach ($alquileres as $alquiler) {
				foreach ($alquiler as $dia) {

					if($fecha_inicio != $dia or $fecha_inicio == end($alquiler)){

						for($i = 1; $i<= $diasNuevaReserva->d; $i++){
							 $diaNuevaReserva = date('d-m-Y', strtotime($fecha_inicio. ' + '.$i.' days'));
							if($diaNuevaReserva == $dia){
								$disponible = false;
								break 3;
							}
						}

					}else{
						$disponible = false;
						break 2;
					}
				}

			}

		}

		return $disponible;
	}

}