<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAusenciasOdontologos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ausencias_odontologos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('odontologo_id')->unsigned();
			$table->date('fecha_desde');
			$table->date('fecha_hasta');
			$table->string('motivo',250);
			$table->timestamps();
			$table->foreign('odontologo_id')->references('id')->on('odontologos');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ausencias_odontologos');
	}

}
