<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pacientes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('apellido',50);
			$table->string('nombres',50);
			$table->date('fecha_nacimiento')->nullable();
			$table->string('tipo_documento',2);
			$table->integer('nro_documento');
			$table->string('sexo',1)->nullable();
			$table->integer('pais_nacimiento_id')->nullable()->unsigned();
			$table->integer('iva_id')->default(1)->unsigned();	
			$table->string('cuit',11)->nullable();
			$table->string('domicilio',50)->nullable();
			$table->string('localidad',50)->nullable();
			$table->integer('provincia_id')->default(1)->unsigned();			
			$table->integer('pais_id')->default(1)->unsigned();	
			$table->string('codigopostal',8)->nullable();
			$table->string('telefono',50)->nullable();			
			$table->string('telefono2',50)->nullable();			
			$table->string('celular',50)->nullable();			
			$table->string('email',254)->nullable();			
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
		Schema::drop('pacientes');
	}

}
