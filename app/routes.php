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


Route::resource('usuario', 'UsuarioController');
Route::resource('rol', 'RolController');
Route::resource('vivienda', 'ViviendaController');
Route::resource('imagen', 'ImagenController');
Route::resource('cliente', 'ClienteController');
Route::resource('alquiler', 'AlquilerController');
