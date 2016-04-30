<?php

class Imagen extends Eloquent {

	protected $table = 'imagenes';
	public $timestamps = true;

	public function vivienda()
	{
		return $this->belongsTo('Vivienda');
	}

	public static function imagenesVivienda($id_vivienda){

		$viviendas = DB::table('imagenes')->where('id_vivienda', '=', $id_vivienda)->get();

		return $viviendas;
	}



}