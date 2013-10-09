<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAlterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('odontologos', function(Blueprint $table)
		{

			DB::update(DB::raw("ALTER TABLE `odontologos` CHANGE `nombre` `nombres` varchar(50) NOT NULL;"));
	 
			DB::update(DB::raw("ALTER TABLE `odontologos` CHANGE `apellido` `apellido` varchar(50) NOT NULL;"));
				

			DB::update(DB::raw("ALTER TABLE `odontologos` CHANGE `matricula` `matricula` varchar(10) NOT NULL;"));
 
			$table->date('fechaalta')->nullable();
			$table->date('fechabaja')->nullable();
			$table->string('sexo',1)->nullable();
			$table->string('domicilio',100)->nullable();
			$table->string('localidad',50)->nullable();			
			$table->smallInteger('provincia_id')->default(1);			
			$table->smallInteger('pais_id')->default(1);	
			$table->string('codigopostal',8)->nullable();
			$table->string('telefono',50)->nullable();			
			$table->string('celular',50)->nullable();			
			$table->string('email',254)->nullable();			
			$table->smallInteger('iva_id')->default(1);			
			$table->string('cuit',11)->nullable();
			$table->boolean('seguropropio')->default(false);
			$table->string('ciaseguropropio',50)->nullable();
			$table->date('vtoseguropropio')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('odontologos', function(Blueprint $table)
		{
			$table->dropColumn('fechaalta');
			$table->dropColumn('fechabaja');
			$table->dropColumn('sexo');
			$table->dropColumn('domicilio');
			$table->dropColumn('localidad');			
			$table->dropColumn('provincia_id');			
			$table->dropColumn('pais_id');	
			$table->dropColumn('codigopostal');
			$table->dropColumn('telefono');			
			$table->dropColumn('celular');			
			$table->dropColumn('email');			
			$table->dropColumn('iva_id');			
			$table->dropColumn('cuit');
			$table->dropColumn('seguropropio');
			$table->dropColumn('ciaseguropropio');
			$table->dropColumn('vtoseguropropio');
			DB::update(DB::raw("ALTER TABLE `odontologos` CHANGE  `nombres` `nombre` varchar(128) NOT NULL;"));
	 
			DB::update(DB::raw("ALTER TABLE `odontologos` CHANGE  `apellido` `apellido` varchar(128) NOT NULL;"));
				

			DB::update(DB::raw("ALTER TABLE `odontologos` CHANGE  `matricula` `matricula` varchar(255) NOT NULL;"));
		});
	}

}
