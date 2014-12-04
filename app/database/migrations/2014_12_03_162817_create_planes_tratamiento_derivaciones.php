<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanesTratamientoDerivaciones extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('planes_tratamiento_derivaciones', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('planes_tratamiento_id')->unsigned();
			$table->integer('especialidad_id')->unsigned();
			$table->integer('numero_orden');
			$table->integer('centro_odontologo_especialidad_id')->unsigned()->nullable();
			$table->text('observaciones_odontologo_quederiva')->nullable();
			$table->text('observaciones_odontologo_queatiende')->nullable();
			$table->char('estado_derivacion',1);
			$table->timestamps();
			$table->foreign('especialidad_id','espe_foreign')->references('id')->on('especialidades');
			$table->foreign('planes_tratamiento_id','deriva_plan_trat_foreign')->references('id')->on('planes_tratamiento');
			$table->foreign('centro_odontologo_especialidad_id','coe_foreign')->references('id')->on('centros_odontologos_especialidades');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('planes_tratmiento_derivaciones');
	}

}
