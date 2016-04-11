<?php

class Vivienda extends Eloquent {

	protected $table = 'viviendas';
	public $timestamps = true;

	public function usuario()
	{
		return $this->belongsTo('Usuario', 'id_usuario');
	}

	public function imagen()
	{
		return $this->hasMany('Imagen', 'id_vivienda');
	}

	public function alquiler()
	{
		return $this->hasMany('Alquiler', 'id_alquiler');
	}

}