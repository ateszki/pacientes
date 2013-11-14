<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('agendas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('centro_odontologo_especialidad_id')->unsigned();
			$table->dateTime('fecha');
			$table->integer('odontologo_efector_id')->unsigned();
			$table->boolean('habilitado_turnos')->default(true);
			$table->string('observaciones',250)->nullable();
			$table->timestamps();
			$table->foreign('odontologo_efector_id')->references('id')->on('odontologos');
			$table->foreign('centro_odontologo_especialidad_id')->references('id')->on('centros_odontologos_especialidades');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('agendas');
	}

}
