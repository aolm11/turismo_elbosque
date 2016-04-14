<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('RolesTableSeeder');
		$this->command->info('Roles table seeded!');

		$this->call('UsuariosTableSeeder');
		$this->command->info('Usuarios table seeded!');

	}



}

class RolesTableSeeder extends Seeder {

	public function run()
	{
		$rol = new Rol();
		$rol->tipo = 'admin';
		$rol->save();

		$rol = new Rol();
		$rol->tipo = 'propietario';
		$rol->save();
	}
}

class UsuariosTableSeeder extends Seeder {

	public function run()
	{
		$admin = new Usuario();
		$admin->nombre = 'Ángel';
		$admin->apellidos = 'Olmedo';
		$admin->email = 'aolmedobenitez@gmail.com';
		$admin->telefono = '658955911';
		$admin->password = Hash::make('asdfasdf');
		$admin->id_rol = 1;
		$admin->save();

	}
}
