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
		$this->call('ProvinciaTableSeeder');
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
         User::create(array(
                 'id' => 2,
                 'nombre' => 'fabio',
         		 'email' => 'fnovello@consulmed.com.ar',
                 'password' => Hash::make('fabio'),
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
                'nombres' => 'Martin',
				'apellido' => 'Palermo',
                'matricula' => 'MN 123456',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
        ));
        Odontologo::create(array(
                'id' => 2,
                'nombres' => 'Guillermo',
				'apellido' => 'Barros Schelotto',
                'matricula' => 'MN 654321',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
        ));
		for ($i=3;$i<1000;$i++){
			$mn = 999000 + $i;
	        Odontologo::create(array(
	                'id' => $i,
	                'nombres' => 'Nombre-'.$i,
					'apellido' => 'Apellido-'.$i,
					'matricula' => 'MN '.$mn,
	                'created_at' => new DateTime,
	                'updated_at' => new DateTime
	        ));
		}
    }
}

class ProvinciaTableSeeder extends Seeder {
 
     public function run()
     {
         DB::table('provincias')->delete();
	$provincias = array(
		"CABA",
		"Buenos Aires",
		"Catamarca",
		"Chaco",
		"Chubut",
		"Córdoba",
		"Corrientes",
		"Entre Rios",
		"Formosa",
		"Jujuy",
		"La Pampa",
		"La Rioja",
		"Mendoza",
		"Misiones",
		"Neuquén",
		"Rio Negro",
		"Salta",
		"San Juan",
		"San Luis",
		"Santa Cruz",
		"Santa Fé",
		"Santiago del Estero",
		"Tierra del Fuego",
		"Tucumán",
	);
	foreach ($provincias as $p){
         Provincia::create(array(
                 'provincia' => $p,
         	 'pais_id' => 1,
                 'created_at' => new DateTime,
                 'updated_at' => new DateTime
         ));
	}
      }
}

