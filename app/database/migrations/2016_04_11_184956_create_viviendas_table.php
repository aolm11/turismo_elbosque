<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateViviendasTable extends Migration {

	public function up()
	{
		Schema::create('viviendas', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_usuario')->unsigned();
			$table->integer('num_habitaciones')->unsigned();
			$table->integer('num_banos')->unsigned();
			$table->integer('capacidad')->unsigned();
			$table->decimal('precio_persona')->nullable();
			$table->decimal('precio_total')->nullable();
			$table->text('descripcion');
			$table->tinyInteger('estado')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('viviendas');
	}
}