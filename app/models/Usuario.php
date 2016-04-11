<?php

class Usuario extends Eloquent {

	protected $table = 'usuarios';
	public $timestamps = true;

	public function rol()
	{
		return $this->belongsTo('Rol', 'id_rol');
	}

	public function vivienda()
	{
		return $this->hasMany('Vivienda', 'id_usuario');
	}

}