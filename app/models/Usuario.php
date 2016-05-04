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

	public static function crearPropietario($input){

		$respuesta = array();

		$reglas = array(
			'nombre' => array('required', 'min:3', 'max:50'),
			'apellidos' => array('required', 'min:3', 'max:100'),
			'telefono'=> array('required', 'max:9'),
			'email' => array('required', 'email', 'max:50', 'unique:usuarios,email'),
			'password' => array('required', 'min:6', 'max:100', 'same:password2'),
			'password2' => array('required', 'min:6', 'max:100'),
		);

		$validator = Validator::make($input, $reglas);

		if ($validator->fails()) {
			$respuesta['mensaje'] = $validator;
			$respuesta['error'] = true;
		} else {

			$usuario = new Usuario();
			$usuario->nombre = $input['nombre'];
			$usuario->apellidos = $input['apellidos'];
			$usuario->email = $input['email'];
			$usuario->password = Hash::make($input['password']);
			$usuario->telefono = $input['telefono'];
			$usuario->id_rol = 2;

			if(isset($input['localidad'])){
				$usuario->localidad = $input['email'];
			}
			$usuario->save();

			$respuesta['mensaje'] = 'Usuario creado';
			$respuesta['error'] = false;
			$respuesta['data'] = $usuario;
			$respuesta['exito'] = true;


			//TODO: email de notificacion.

			$data = array(

				'nombre'=>$usuario->nombre,
				'apellidos'=>$usuario->apellidos,
				'email'=>$usuario->email,
				'password'=>$input['password'],
			);

			Mail::send('emails.emailRespuesta', $data, function ($message) use ($usuario) {
				$email = $usuario->email;
				$message->to($email)->subject('Bienvenido a Turismo El Bosque');
			});

		}

		return $respuesta;
	}

	public static function eliminarPropietario($id_propietario){

		//TODO: Borrado en cascada en base de datos??

		$respuesta = array();

		$propietario = Usuario::find($id_propietario);

		$viviendas = Vivienda::viviendasPropietario($id_propietario);

		$reservas = Alquiler::reservasPropietario($id_propietario);

		$respuesta['mensaje'] = 'Propietario ';

		if(!empty($viviendas)){

			if(!empty($reservas)){
				foreach ($reservas as $reserva) {
					$reserva->delete();
				}
				$respuesta['mensaje'] .= ',reservas, ';
			}

			foreach ($viviendas as $vivienda) {
				$vivienda->delete();
			}

			$respuesta['mensaje'] .= 'y viviendas eliminados';

		}else{
			$respuesta['mensaje'] .= 'eliminado';
		}

		$propietario->delete();

		$respuesta['error'] = false;
		$respuesta['exito'] = true;

		return $respuesta;

	}

	public static function propietario(){

		$propietario = Usuario::find(Auth::id());
	}

}