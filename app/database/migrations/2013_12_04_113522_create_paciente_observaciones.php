<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacienteObservaciones extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('observaciones_pacientes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tipo')->unsigned();
			$table->integer('paciente_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('observacion',250);
			$table->timestamps();
			$table->foreign('paciente_id')->references('id')->on('pacientes');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('observaciones_pacientes');
	}

}
