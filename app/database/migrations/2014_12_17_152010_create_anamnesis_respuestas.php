<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnamnesisRespuestas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('anamnesis_respuestas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('paciente_id')->unsigned();
			$table->integer('anamnesis_pregunta_id')->unsigned();
			$table->string('respuesta',512)->nullable();
			$table->timestamps();
			$table->foreign('paciente_id')->references('id')->on('pacientes');
			$table->foreign('anamnesis_pregunta_id')->references('id')->on('anamnesis_preguntas');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('anamnesis_respuestas');
	}

}
