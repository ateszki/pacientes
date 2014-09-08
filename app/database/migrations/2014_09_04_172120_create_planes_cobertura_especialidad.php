<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanesCoberturaEspecialidad extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('planes_cobertura_especialidad', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('planes_cobertura_id')->unsigned();
			$table->integer('especialidad_id')->unsigned();
			$table->timestamps();
			$table->foreign('planes_cobertura_id')->references('id')->on('planes_cobertura');
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
		Schema::drop('planes_cobertura_especialidad');
	}

}
