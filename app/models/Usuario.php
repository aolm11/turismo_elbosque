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
	protected $fillable = array('id', 'id_rol', 'nombre','apellidos', 'telefono', 'email', 'password', 'permiso_app', 'alta');
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
			if ($rol->id == 2 and Auth::user()->alta == 1) {
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
			'telefono'=> array('required','min:9', 'max:9'),
			'email' => array('required', 'email', 'max:50', 'unique:usuarios,email'),
			'password' => array('required', 'min:6', 'max:100', 'same:password2'),
			'password2' => array('required', 'min:6', 'max:100'),
		);

		$validator = Validator::make($input, $reglas);

		if ($validator->fails()) {
			$respuesta['mensaje'] = $validator;
			$respuesta['error'] = true;
		} else {

			$propietario = new Usuario();
			$propietario->nombre = $input['nombre'];
			$propietario->apellidos = $input['apellidos'];
			$propietario->email = $input['email'];
			$propietario->password = Hash::make($input['password']);
			$propietario->telefono = $input['telefono'];
			$propietario->id_rol = 2;
			$propietario->alta = 1;

			if(isset($input['permiso_app'])){
				$propietario->permiso_app = 1;
			}
			$propietario->save();

			$respuesta['mensaje'] = 'Propietario creado';
			$respuesta['error'] = false;
			$respuesta['data'] = $propietario;
			$respuesta['exito'] = true;

			$data = array(

				'nombre'=>$propietario->nombre,
				'apellidos'=>$propietario->apellidos,
				'email'=>$propietario->email,
				'password'=>$input['password'],
			);

			Mail::send('emails.emailRespuesta', $data, function ($message) use ($propietario) {
				$email = $propietario->email;
				$message->to($email)->subject('Bienvenido a Turismo El Bosque');
			});

		}

		return $respuesta;
	}

	public static function editarPropietario($id, $input){
		$respuesta = array();

		$propietario = Usuario::find($id);

		$reglas = array(
			'nombre' => array('required', 'min:3', 'max:50'),
			'apellidos' => array('required', 'min:3', 'max:100'),
			'telefono' => array('required', 'min:9', 'max:9'),
		);

		if($input['email'] != $propietario->email){
			$reglas=array_push($reglas,'email',array('email', 'max:50', 'unique:usuarios,email'));;
		}

		$validator = Validator::make($input, $reglas);

		if ($validator->fails()) {
			$respuesta['mensaje'] = $validator;
			$respuesta['error'] = true;
		} else {

			$propietario->nombre = $input['nombre'];
			$propietario->apellidos = $input['apellidos'];
			$propietario->email = $input['email'];
			$propietario->telefono = $input['telefono'];

			if (isset($input['permiso_app'])) {
				$propietario->permiso_app = 1;
			}
			$propietario->save();

			$respuesta['mensaje'] = 'Propietario editado';
			$respuesta['error'] = false;
			$respuesta['data'] = $propietario;
			$respuesta['exito'] = true;

		}

		//TODO: email de notificación de modificación de datos..


		return $respuesta;
	}

	public static function darDeBajaPropietario($id_propietario){

		$respuesta = array();

		$propietario = Usuario::find($id_propietario);

		$propietario->alta = 0;

		$propietario->save();

		$respuesta['mensaje'] = 'El propietario ha sido dado de baja';
		$respuesta['error'] = false;
		$respuesta['exito'] = true;

		return $respuesta;


	}

	public static function darDeAltaPropietario($id_propietario){

		$respuesta = array();

		$propietario = Usuario::find($id_propietario);

		$propietario->alta = 1;

		$propietario->save();

		$respuesta['mensaje'] = 'El propietario ha sido dado de alta';
		$respuesta['error'] = false;
		$respuesta['exito'] = true;

		return $respuesta;
	}

	public static function eliminarPropietario($id_propietario){

		$respuesta = array();

		$propietario = Usuario::find($id_propietario);

		$viviendas = Vivienda::viviendasPropietario($id_propietario);

		$reservas = Alquiler::reservasPropietarioSinConfirmar($id_propietario);

		$respuesta['mensaje'] = 'Propietario ';

		if(!empty($viviendas)){

			if(!empty($reservas)){
				foreach ($reservas as $reserva) {
					Alquiler::find($reserva->id)->delete();
				}
				$respuesta['mensaje'] .= ',reservas, ';
			}

			foreach ($viviendas as $vivienda) {

				$imagenes = Imagen::imagenesVivienda($vivienda->id);

				foreach ($imagenes as $imagen) {
					Imagen::find($imagen->id)->delete();
				}

				Vivienda::find($vivienda->id)->delete();
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