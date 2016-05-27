<?php

class Alquiler extends Eloquent {

	protected $table = 'alquiler';
	protected $fillable = array('id_vivienda', 'id_cliente','fecha_inicio','fecha_fin', 'mensaje');
	protected $hidden = array('remember_token');

	public $timestamps = true;

	public function vivienda()
	{
		return $this->belongsTo('Vivienda');
	}

	public function cliente()
	{
		return $this->belongsTo('Cliente');
	}


	public static function crearReserva($input){
		$respuesta = array();

		$reglas = array(
			'nombre' => array('required', 'min:3', 'max:100'),
			'telefono'=> array('required','min:9', 'max:9'),
			'email' => array('required', 'email', 'max:100'),
			'entrada' => array('required', 'date_format:d-m-Y'),
			'salida' => array('required', 'date_format:d-m-Y'),
			'vivienda' => array('required'),

		);

		$validator = Validator::make($input, $reglas);

		if ($validator->fails()) {
			$respuesta['mensaje'] = $validator;
			$respuesta['error'] = true;
		} else {

			if(Vivienda::viviendaDisponible($input['vivienda'],$input['entrada'],$input['salida'])){

				$cliente = Cliente::getClienteByEmail($input['email']);
				if(is_null($cliente)){
					$cliente = new Cliente();
					$cliente->nombre = $input['nombre'];
					$cliente->email = $input['email'];
					$cliente->telefono = $input['telefono'];
					$cliente->save();
				}

				$reserva = new Alquiler();
				$reserva->id_vivienda = $input['vivienda'];
				$reserva->id_cliente = $cliente->id;
				$reserva->fecha_inicio = Herramientas::formatearFechaBD($input['entrada']);
				$reserva->fecha_fin = Herramientas::formatearFechaBD($input['salida']);
				$reserva->confirmado = 1;
				$reserva->save();

				$respuesta['mensaje'] = 'Reserva creada y confirmada';
				$respuesta['error'] = false;
				$respuesta['exito'] = true;
			}else{
				$respuesta['mensaje'] = 'La vivienda no está disponible en las fechas selecciondas. Elimine la reserva para poder añadir una nueva.';
				$respuesta['error'] = false;
				$respuesta['exito'] = false;
			}
		}
		return $respuesta;
	}

	public static function editarReserva($id, $input){
		$respuesta = array();

		$reglas = array(
			'nombre' => array('required', 'min:3', 'max:100'),
			'telefono'=> array('required','min:9', 'max:9'),
			'email' => array('required', 'email', 'max:100'),
			'entrada' => array('required', 'date_format:d-m-Y'),
			'salida' => array('required', 'date_format:d-m-Y'),
			'vivienda' => array('required'),

		);

		$validator = Validator::make($input, $reglas);

		if ($validator->fails()) {
			$respuesta['mensaje'] = $validator;
			$respuesta['error'] = true;
		} else {

			//TODO. Distinguir si fecha inicio y fecha fin son iguales, Si lo son, actualizar todo menos las fechas. Si es igual fecha inicio
			//TODO añadir bandera a viviendaDisponible, $editando para que compruebe el resto de dias ; si no es igual comprobar normal.

			if(Vivienda::viviendaDisponible($input['vivienda'],$input['entrada'],$input['salida'])){

				$reserva = Alquiler::find($id);

				$cliente = Cliente::find($reserva->id_cliente);
				$cliente->nombre = $input['nombre'];
				$cliente->email = $input['email'];
				$cliente->telefono = $input['telefono'];
				$cliente->save();

				$reserva->id_vivienda = $input['vivienda'];
				$reserva->id_cliente = $cliente->id;
				$reserva->fecha_inicio = Herramientas::formatearFechaBD($input['entrada']);
				$reserva->fecha_fin = Herramientas::formatearFechaBD($input['salida']);
				$reserva->save();

				$respuesta['mensaje'] = 'Reserva editada';
				$respuesta['error'] = false;
				$respuesta['exito'] = true;
			}else{
				$respuesta['mensaje'] = 'La vivienda no está disponible en las fechas selecciondas. Elimine la reserva para poder añadir una nueva.';
				$respuesta['error'] = false;
				$respuesta['exito'] = false;
			}
		}
		return $respuesta;
	}

	public static function eliminarReservaConfirmada($id_reserva){

		$respuesta = array();

		$reserva =  Alquiler::find($id_reserva);

		$reserva->delete();

		$respuesta['mensaje'] = 'Reserva eliminada';
		$respuesta['data'] = $reserva;
		$respuesta['exito'] = true;

		return $respuesta;

		//TODO Email informando al cliente. (Enviar contacto del propietario por si quiere saber más).


	}

	public static function reservasPropietarioConfirmadas($id_usuario){

		$reservas = DB::table('alquiler')
			->join('viviendas','alquiler.id_vivienda', '=', 'viviendas.id')
			->where('viviendas.id_usuario', '=', $id_usuario)
			->where('alquiler.confirmado', '=', 1)
			->select('alquiler.id as id_alquiler', 'id_vivienda', 'id_cliente', 'fecha_inicio', 'fecha_fin', 'nombre')
			->get();

		return $reservas;
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

	public static function reservasConfirmadas($id_vivienda){

		$reservas = DB::table('alquiler')
			->where('id_vivienda', '=', $id_vivienda)
			->where('confirmado', '=', 1)
			->get();

		return $reservas;
	}

	public static function getDiasAlquilados($fecha_inicio, $fecha_fin){

		$fecha_inicio = new DateTime($fecha_inicio);

		$fecha_fin = new DateTime($fecha_fin);

		$dias = $fecha_inicio->diff($fecha_fin);

		return $dias;




	}

}