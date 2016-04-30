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
	return View::make('inicio');
});

Route::post('login', function () {

	if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')), true)) {

		return Redirect::to('inicio');
	} else {
		return Redirect::back()->with('mensaje', 'El email o la contraseña introducidos no son válidos');
	}

});

Route::get('inicio', function () {
	return Redirect::to('/');

});


Route::filter('admin', function () {
	if (!Usuario::esAdmin())
		return View::make('401', array(), 401);
});

Route::filter('propietario', function () {
	if (!Usuario::esPropietario())
		return View::make('401', array(), 401);
});

Route::group(array('before' => ['auth']), function () {

	Route::group(array('before' => 'admin'), function () {

		/*Route::get('/', function () {
			$propietarios = Usuario::getPropietarios();
			return Redirect::to('admin')->with(['propietarios' => $propietarios]);
		});*/

		Route::get('admin', 'UsuarioController@admin');

		Route::post('nuevoPropietario', 'UsuarioController@crearPropietario');

	});

	Route::group(array('before' => 'propietario'), function(){

		Route::get('propietario', 'UsuarioController@propietario');

		Route::get('nueva/vivienda', function(){
			return View::make('crear_vivienda');
		});

		Route::post('crear/vivienda', 'ViviendaController@crear');

		Route::get('vivienda/edicion/{id}', 'ViviendaController@edicion');

		Route::post('vivienda/editar/{id}', 'ViviendaController@editar');

		Route::post('add/imagen/{id}', 'ViviendaController@addImagen');


	});

	Route::get('/', function () {
		if (Usuario::esAdmin()) {
			return Redirect::to('admin');
		} elseif (Usuario::esPropietario()) {
			return Redirect::to('propietario');
		} else {
			// retornar a vista sin permisos.
		}

	});

	Route::post('crearPropietario', 'UsuarioController@crearPropietario');

});



Route::get('logout', 'UsuarioController@logout');

Route::resource('usuario', 'UsuarioController');
Route::resource('rol', 'RolController');
Route::resource('vivienda', 'ViviendaController');
Route::resource('imagen', 'ImagenController');
Route::resource('cliente', 'ClienteController');
Route::resource('alquiler', 'AlquilerController');
