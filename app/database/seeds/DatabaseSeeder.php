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

		$this->call('UserTableSeeder');
		$this->call('OdontologoTableSeeder');
	}

}
class UserTableSeeder extends Seeder {
 
     public function run()
     {
         DB::table('users')->delete();
         User::create(array(
                 'id' => 1,
                 'nombre' => 'admin',
         	'email' => 'sistemas@consulmed.com.ar',
                 'password' => Hash::make('admin'),
                 'created_at' => new DateTime,
                 'updated_at' => new DateTime
         ));
     }
}
 
class OdontologoTableSeeder extends Seeder {
    public function run()
    {
        DB::table('odontologos')->delete();
        Odontologo::create(array(
                'id' => 1,
                'nombre' => 'Martin',
		'apellido' => 'Palermo',
                'matricula' => 'MN 123456',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
        ));
        Odontologo::create(array(
                'id' => 1,
                'nombre' => 'Guillermo',
		'apellido' => 'Barros Schelotto',
                'matricula' => 'MN 654321',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
        ));
    }
}
