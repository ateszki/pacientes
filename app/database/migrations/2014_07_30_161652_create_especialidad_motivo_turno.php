<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspecialidadMotivoTurno extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('especialidad_motivo_turno', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('especialidad_id')->unsigned();
			$table->integer('motivo_turno_id')->unsigned();
			$table->timestamps();
			$table->foreign('especialidad_id')->references('id')->on('especialidades');
			$table->foreign('motivo_turno_id')->references('id')->on('motivos_turnos');
			$table->unique(array('especialidad_id','motivo_turno_id'));

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('especialidad_motivo_turno');
	}

}
