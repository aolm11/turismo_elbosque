<?php

class Vivienda extends Eloquent {

	protected $table = 'viviendas';
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

	public static function viviendasPropietario($idPropietario){
		$viviendas = DB::table('viviendas')->where('id_usuario', '=', $idPropietario)->get();
		return $viviendas;
	}

	public static function crear($input){

		$respuesta = array();

		$reglas = array(
			'nombre' => array('required', 'min:3', 'max:100'),
			'direccion' => array('required', 'min:3', 'max:200'),
			'num_habitaciones' => array('required','integer',  'between:1,11'),
			'num_banos'=> array('required', 'integer', 'between:1,6'),
			'capacidad' => array('required', 'integer', 'min:1'),
			'descripcion' => array('required', 'alpha_num'),
		);

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

			if(isset($input['precio_total'])){
				$vivienda->precio_total = $input['precio_total'];
			}

			$vivienda->save();

			$respuesta['mensaje'] = 'Vivienda creada';
			$respuesta['error'] = false;
			$respuesta['data'] = $vivienda;

		}
		return $respuesta;
	}

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

			if(isset($input['precio_total'])){
				$vivienda->precio_total = $input['precio_total'];
			}

			$vivienda->save();

			$respuesta['mensaje'] = 'Vivienda creada';
			$respuesta['error'] = false;
			$respuesta['data'] = $vivienda;

		}
		return $respuesta;
	}

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

				$nombreImagen = $vivienda->nombre. count(Imagen::imagenesVivienda($id_vivienda))+1 . ".jpg";
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

			}else{
				$respuesta['mensaje'] = 'No ha seleccionado ninguna imagen';
				$respuesta['error'] = false;
				$respuesta['data'] = null;
			}
		}

		return $respuesta;
	}

}