<?php

class Rol extends Eloquent {

	protected $table = 'roles';
	protected $fillable = array('id','tipo');

	public function usuarios()
	{
		return $this->hasMany('Usuario');
	}

}