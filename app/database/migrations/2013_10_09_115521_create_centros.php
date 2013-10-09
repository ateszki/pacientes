<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentros extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('centros', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('razonsocial',100);
			$table->string('domicilio',100)->nullable();
			$table->string('localidad',50)->nullable();					$table->smallInteger('provincia_id')->default(1);	
			$table->smallInteger('pais_id')->default(1);	
			$table->string('codigopostal',8)->nullable();
			$table->string('telefono',50)->nullable();		
			$table->string('celular',50)->nullable();	
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('centros');
	}

}
