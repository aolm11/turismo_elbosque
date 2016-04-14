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

}