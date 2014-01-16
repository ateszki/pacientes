<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientesObservaciones extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('paciente_observaciones', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('paciente_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->text('observacion');
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('paciente_id')->references('id')->on('pacientess');
		//	Schema::drop('observaciones_pacientes');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('paciente_observaciones');
	}

}
