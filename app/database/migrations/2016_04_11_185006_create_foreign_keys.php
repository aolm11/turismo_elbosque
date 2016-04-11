<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('usuarios', function(Blueprint $table) {
			$table->foreign('id_rol')->references('id')->on('roles')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('viviendas', function(Blueprint $table) {
			$table->foreign('id_usuario')->references('id')->on('usuarios')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('imagenes', function(Blueprint $table) {
			$table->foreign('id_vivienda')->references('id')->on('viviendas')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('alquiler', function(Blueprint $table) {
			$table->foreign('id_vivienda')->references('id')->on('viviendas')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('alquiler', function(Blueprint $table) {
			$table->foreign('id_cliente')->references('id')->on('clientes')
						->onDelete('no action')
						->onUpdate('no action');
		});
	}

	public function down()
	{
		Schema::table('usuarios', function(Blueprint $table) {
			$table->dropForeign('usuarios_id_rol_foreign');
		});
		Schema::table('viviendas', function(Blueprint $table) {
			$table->dropForeign('viviendas_id_usuario_foreign');
		});
		Schema::table('imagenes', function(Blueprint $table) {
			$table->dropForeign('imagenes_id_vivienda_foreign');
		});
		Schema::table('alquiler', function(Blueprint $table) {
			$table->dropForeign('alquiler_id_vivienda_foreign');
		});
		Schema::table('alquiler', function(Blueprint $table) {
			$table->dropForeign('alquiler_id_cliente_foreign');
		});
	}
}