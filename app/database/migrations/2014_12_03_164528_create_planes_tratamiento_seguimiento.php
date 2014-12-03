<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanesTratamientoSeguimiento extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('planes_tratamiento_seguimiento', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('planes_tratamiento_id')->unsigned();
			$table->date('fecha');
			$table->integer('centro_odontologo_especialidad_id')->unsigned();
			$table->text('observaciones')->nullable();
			$table->timestamps();
			$table->foreign('planes_tratamiento_id','plseg_plan_trat_foreign')->references('id')->on('planes_tratamiento');
			$table->foreign('centro_odontologo_especialidad_id','plseg_coe_foreign')->references('id')->on('centros_odontologos_especialidades');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('planes_tratamiento_seguimiento');
	}

}
