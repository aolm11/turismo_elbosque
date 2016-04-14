<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagenesTable extends Migration {

	public function up()
	{
		Schema::create('imagenes', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_vivienda')->unsigned();
			$table->text('nombre');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('imagenes');
	}
}