<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientesTable extends Migration {

	public function up()
	{
		Schema::create('clientes', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nombre', 100);
			$table->string('email', 100);
			$table->string('telefono', 9)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clientes');
	}
}