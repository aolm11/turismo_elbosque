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

Route::get('viviendas', 'ViviendaController@viviendas');

Route::get('detalles/vivienda/{id}', 'ViviendaController@detallesVivienda');

Route::post('login', function () {

	if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')), true)) {
		if(Auth::user()->id_rol == 2 and Auth::user()->alta == 0){
			Auth::logout();
			return Redirect::back()->with('mensaje', 'Su cuenta de propietario se encuentra desactivada. Póngase en contacto con el administrador.');
		}else{
			return Redirect::to('inicio');
		}
	} else {
		return Redirect::back()->with('mensaje', 'El email o la contraseña introducidos no son válidos');
	}

});

Route::get('inicio', function () {
	return Redirect::to('/');

});

Route::post('viviendas/filtradas', 'ViviendaController@viviendasFiltradas');

Route::post('enviar/reserva', 'AlquilerController@crearNotificacion');

Route::filter('admin', function () {
	if (!Usuario::esAdmin())
		return Response::view('401', array(), 401);
});

Route::filter('propietario', function () {
	if (!Usuario::esPropietario())
		return Response::view('401', array(), 401);
});

Route::group(array('before' => ['auth']), function () {


	Route::get('perfil/usuario/{id}', 'UsuarioController@edicionPerfil');

	Route::post('usuario/editar/{id}', 'UsuarioController@editarPerfil');

	Route::get('logout', 'UsuarioController@logout');


	Route::group(array('before' => 'admin'), function () {

		Route::get('admin', 'UsuarioController@admin');

		Route::post('nuevo/propietario', 'UsuarioController@crearPropietario');

		Route::post('editar/propietario/{id}', 'UsuarioController@editarPropietario');

		Route::get('propietario/alta/{id}', 'UsuarioController@darDeAltaPropietario');

		Route::get('propietario/baja/{id}', 'UsuarioController@darDeBajaPropietario');

		Route::get('propietario/eliminar/{id}', 'UsuarioController@eliminarPropietario');

	});

	Route::group(array('before' => 'propietario'), function(){

		Route::get('propietario', 'UsuarioController@propietario');

		Route::get('nueva/vivienda', function(){
			return View::make('crear_vivienda');
		});

		Route::post('crear/vivienda', 'ViviendaController@crear');

		Route::get('vivienda/eliminar/{id}', 'ViviendaController@borrar');

		Route::get('reservas/vivienda/{id}', 'ViviendaController@fechasReservadasVivienda');


		Route::get('vivienda/edicion/{id}', 'ViviendaController@edicion');

		Route::post('vivienda/editar/{id}', 'ViviendaController@editar');

		Route::post('add/imagen/{id}', 'ViviendaController@addImagen');

		Route::get('eliminar/imagen/{id}', 'ImagenController@borrar');

		Route::post('crear/reserva', 'AlquilerController@crearReserva');

		Route::post('reserva/editar/{id}', 'AlquilerController@editarReserva');

		Route::get('detalles/reserva/{id}', 'AlquilerController@detallesReserva');

		Route::get('confirmar/reserva/{id}', 'AlquilerController@confirmarReserva');

		Route::get('eliminar/reserva/{id}', 'AlquilerController@eliminarReserva');

		Route::post('generar/informe', 'AlquilerController@generarInforme');




	});

});

