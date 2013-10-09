<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentrosOdontologosEspecialidades extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('centros_odontologos_especialidades', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('centro_id')->unsigned();
			$table->integer('odontologo_id')->unsigned();
			$table->integer('especialidad_id')->unsigned();
			$table->timestamps();
			$table->foreign('centro_id')->references('id')->on('centros');
			$table->foreign('odontologo_id')->references('id')->on('odontologos');
			$table->foreign('especialidad_id')->references('id')->on('especialidades');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('centros_odontologos_especialidades');
	}

}
