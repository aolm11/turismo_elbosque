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

	public static function reservasPropietario($id_usuario){

		$reservas = DB::table('alquiler')
			->join('viviendas','alquiler.id_vivienda', '=', 'viviendas.id')
			->where('viviendas.id_usuario', '=', $id_usuario)->get();

		return $reservas;
	}

	public static function reservasVivienda($id_vivienda){

		$reservas = DB::table('alquiler')
			->where('id_vivienda', '=', $id_vivienda)->get();

		return $reservas;
	}

}