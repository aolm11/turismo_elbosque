<?php

class Imagen extends Eloquent {

	protected $table = 'imagenes';
	public $timestamps = true;

	public function vivienda()
	{
		return $this->belongsTo('Vivienda');
	}

}