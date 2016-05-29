<?php

class Cliente extends Eloquent {

	protected $table = 'clientes';
	protected $fillable = array('id', 'nombre','telefono', 'email');
	protected $hidden = array('remember_token');

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