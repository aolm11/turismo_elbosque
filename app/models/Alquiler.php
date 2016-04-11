<?php

class Alquiler extends Eloquent {

	protected $table = 'alquiler';
	public $timestamps = true;

	public function vivienda()
	{
		return $this->belongsTo('Vivienda', 'id_vivienda');
	}

	public function cliente()
	{
		return $this->belongsTo('Cliente', 'id_cliente');
	}

}