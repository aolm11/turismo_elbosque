<?php

class Alquiler extends Eloquent {

	protected $table = 'alquiler';
	public $timestamps = true;

	public function vivienda()
	{
		return $this->belongsTo('Vivienda');
	}

	public function cliente()
	{
		return $this->belongsTo('Cliente');
	}


	public static function crearReserva($id_propietario, $input){
		$respuesta = array();

		$propietario = Usuario::find($id_propietario);

		$reglas = array(
			'nombre' => array('required', 'min:3', 'max:100'),
			'telefono'=> array('required','min:9', 'max:9'),
			'email' => array('required', 'email', 'max:100'),
			'entrada' => array('required', 'date_format:dd/mm/yyyy'),
			'salida' => array('required', 'date_format:dd/mm/yyyy'),
			'vivienda' => array('required'),

		);

		$validator = Validator::make($input, $reglas);

		if ($validator->fails()) {
			$respuesta['mensaje'] = $validator;
			$respuesta['error'] = true;
		} else {

			$vivienda = Vivienda::find($input['vivienda']);
		}
	}

	public static function reservasPropietarioSinConfirmar($id_usuario){

		$reservas = DB::table('alquiler')
			->join('viviendas','alquiler.id_vivienda', '=', 'viviendas.id')
			->where('viviendas.id_usuario', '=', $id_usuario)
			->where('alquiler.confirmado', '=', 0)
			->get();

		return $reservas;
	}

	public static function reservasVivienda($id_vivienda){

		$reservas = DB::table('alquiler')
			->where('id_vivienda', '=', $id_vivienda)->get();

		return $reservas;
	}

	public static function getDiasAlquilados($fecha_inicio, $fecha_fin){

		$fecha_inicio = new DateTime($fecha_inicio);

		$fecha_fin = new DateTime($fecha_fin);

		$dias = $fecha_inicio->diff($fecha_fin);

		return $dias;




	}

}