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

	/**
	 * Consulta que obtiene un cliente por su email.
	 */
	public static function getClienteByEmail($email){
		$cliente = DB::table('clientes')->where('email', '=', $email)->first();
		return $cliente;
	}

}