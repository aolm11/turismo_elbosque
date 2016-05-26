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
		return Response::view('401', array(), 401);
});

Route::filter('propietario', function () {
	if (!Usuario::esPropietario())
		return Response::view('401', array(), 401);
});

Route::group(array('before' => ['auth']), function () {

	Route::group(array('before' => 'admin'), function () {

		/*Route::get('/', function () {
			$propietarios = Usuario::getPropietarios();
			return Redirect::to('admin')->with(['propietarios' => $propietarios]);
		});*/

		Route::get('admin', 'UsuarioController@admin');

		Route::post('nuevo/propietario', 'UsuarioController@crearPropietario');

		Route::post('editar/propietario/{id}', 'UsuarioController@editarPropietario');

		Route::get('propietario/alta/{id}', 'UsuarioController@darDeAltaPropietario');

		Route::get('propietario/baja/{id}', 'UsuarioController@darDeBajaPropietario');

		Route::get('propietario/eliminar/{id}', 'UsuarioController@eliminarPropietario');


		//Route::post('nuevoPropietario', 'UsuarioController@crearPropietario');

	});

	Route::group(array('before' => 'propietario'), function(){

		Route::get('propietario', 'UsuarioController@propietario');

		Route::get('nueva/vivienda', function(){
			return View::make('crear_vivienda');
		});

		Route::post('crear/vivienda', 'ViviendaController@crear');

		Route::get('vivienda/eliminar/{id}', 'ViviendaController@borrar');


		Route::get('vivienda/edicion/{id}', 'ViviendaController@edicion');

		Route::post('vivienda/editar/{id}', 'ViviendaController@editar');

		Route::post('add/imagen/{id}', 'ViviendaController@addImagen');

		Route::get('eliminar/imagen/{id}', 'ImagenController@borrar');

		Route::post('crear/reserva', 'AlquilerController@crearReserva');

		Route::get('eliminar/reserva/{id}', 'AlquilerController@eliminarReservaConfirmada');




	});

	/*Route::get('/', function () {
		if (Usuario::esAdmin()) {
			return Redirect::to('admin');
		} elseif (Usuario::esPropietario()) {
			return Redirect::to('propietario');
		} else {
			// retornar a vista sin permisos.
		}

	});*/


});



Route::get('logout', 'UsuarioController@logout');

Route::resource('usuario', 'UsuarioController');
Route::resource('rol', 'RolController');
Route::resource('vivienda', 'ViviendaController');
Route::resource('imagen', 'ImagenController');
Route::resource('cliente', 'ClienteController');
Route::resource('alquiler', 'AlquilerController');

Route::get('prueba', function(){

	//dd(Vivienda::viviendaDisponible(2, '01-06-2016','07-06-2016'));
	dd(Cliente::getClienteByEmail('ads@ds.com'));

});
