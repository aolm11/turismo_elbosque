<?php 

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', function()
{
	return View::make('template');
});

Route::post('login', function () {

	if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')), true)) {

		return Redirect::to('/');
	} else {
		return Redirect::back()->with('mensaje', 'El email o la contraseña introducidos no son válidos');
	}

});


Route::group(array('before' => ['auth']), function () {

	Route::get('/', function () {
		if (Usuario::esAdmin()) {
			$propietarios = Usuario::getPropietarios();
			return Redirect::to('admin');
		} elseif (Usuario::esPropietario()) {
			//return View::make('propietario')->with(['propietarios' => $propietarios]);
		} else {
			// retornar a vista sin permisos.
		}

	});
});

Route::get('admin', 'UsuarioController@admin');

Route::resource('usuario', 'UsuarioController');
Route::resource('rol', 'RolController');
Route::resource('vivienda', 'ViviendaController');
Route::resource('imagen', 'ImagenController');
Route::resource('cliente', 'ClienteController');
Route::resource('alquiler', 'AlquilerController');
