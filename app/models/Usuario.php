<?php

// se debe indicar en donde esta la interfaz a implementar
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserTrait;
//Para el recordatorio de pass
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'usuarios';
	protected $fillable = array('nombre','apellidos', 'telefono', 'email', 'localidad', 'password');
	protected $hidden = array('password', 'remember_token');

	public function rol()
	{
		return $this->belongsTo('Rol', 'id_rol', 'id');
	}

	public function vivienda()
	{
		return $this->hasMany('Vivienda', 'id_usuario', 'id');
	}

	// este metodo se debe implementar por la interfaz
	public function getAuthIdentifier(){
		return $this->getKey();
	}

	//este metodo se debe implementar por la interfaz
	// y sirve para obtener la clave al momento de validar el inicio de sesión
	public function getAuthPassword(){
		return $this->password;
	}

	public function getRememberToken()
	{
		return $this->remember_token;
	}


	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}


	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	public static function esAdmin(){
		if (Auth::check() == true) {
			$idRol=Auth::user()->id_rol;

			$rol = DB::table('roles')->where('id', '=', $idRol)->first();
			if ($rol->id == 1) {
				return true;
			}
		} else {
			return false;
		}
	}

	public static function esPropietario(){
		if (Auth::check() == true) {
			$idRol=Auth::user()->id_rol;

			$rol = DB::table('roles')->where('id', '=', $idRol)->first();
			if ($rol->id == 2) {
				return true;
			}
		} else {
			return false;
		}
	}

	public static function getPropietarios(){
		$propietarios = DB::table('usuarios')->where('id_rol', '=', 2)->get();

		return $propietarios;
	}

}