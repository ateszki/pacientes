<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanesTratamiento extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('planes_tratamiento', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('paciente_id')->unsigned();
			$table->integer('centro_odontologo_especialidad_id')->unsigned();
			$table->date('fecha');
			$table->text('diagnostico')->nullable();
			$table->timestamps();
			$table->foreign('paciente_id')->references('id')->on('pacientes');
			$table->foreign('centro_odontologo_especialidad_id','planes_trat_coe_foreign')->references('id')->on('centros_odontologos_especialidades');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('planes_tratmiento');
	}

}
