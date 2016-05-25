<?php

class Cliente extends Eloquent {

	protected $table = 'clientes';
	public $timestamps = true;

	public function alquiler()
	{
		return $this->hasMany('Alquiler');
	}

	public static function getClienteByEmail($email){
		$cliente = DB::table('clientes')->where('email', '=', $email)->first();
		return $cliente;
	}

}