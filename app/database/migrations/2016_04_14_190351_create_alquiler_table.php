<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlquilerTable extends Migration {

	public function up()
	{
		Schema::create('alquiler', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_vivienda')->unsigned();
			$table->integer('id_cliente')->unsigned();
			$table->date('fecha_inicio');
			$table->date('fecha_fin');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('alquiler');
	}
}