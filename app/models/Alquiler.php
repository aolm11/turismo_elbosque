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

}