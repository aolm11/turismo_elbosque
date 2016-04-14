<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuariosTable extends Migration {

	public function up()
	{
		Schema::create('usuarios', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_rol')->unsigned();
			$table->string('nombre', 50);
			$table->string('apellidos', 100);
			$table->string('telefono', 9);
			$table->string('email', 50)->unique();
			$table->string('localidad', 80)->nullable();
			$table->string('password', 100);
			$table->text('remember_token')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('usuarios');
	}
}