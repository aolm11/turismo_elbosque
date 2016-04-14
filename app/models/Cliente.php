<?php

class Cliente extends Eloquent {

	protected $table = 'clientes';
	public $timestamps = true;

	public function alquiler()
	{
		return $this->hasMany('Alquiler');
	}

}