<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientesPrepagas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('paciente_prepaga', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('paciente_id')->unsigned();
			$table->integer('prepaga_id')->unsigned();
			$table->timestamps();
			$table->foreign('paciente_id')->references('id')->on('pacientes');
			$table->foreign('prepaga_id')->references('id')->on('prepagas');
			$table->unique(array('paciente_id','prepaga_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('paciente_prepaga');
	}

}
