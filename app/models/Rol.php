<?php

class Rol extends Eloquent {

	protected $table = 'roles';
	public $timestamps = true;

	public function usuario()
	{
		return $this->hasMany('Usuario', 'id_rol');
	}

}