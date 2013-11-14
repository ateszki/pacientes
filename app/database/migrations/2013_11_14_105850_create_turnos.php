<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurnos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */	
	public function up()
	{
		Schema::create('turnos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('agenda_id')->unsigned();
			$table->string('hora_desde',4);
			$table->string('hora_hasta',4);
			$table->string('tipo_turno',1);
			$table->string('estado',1);
			$table->integer('prepaga_id')->unsigned()->nullable();
			$table->integer('motivo_turno_id')->unsigned()->nullable();
			$table->string('piezas',30)->nullable();
			$table->string('derivado_por',50)->nullable();
			$table->string('observaciones',250)->nullable();
			$table->timestamps();
			$table->foreign('agenda_id')->references('id')->on('agendas');
			$table->foreign('prepaga_id')->references('id')->on('prepagas');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('turnos');
	}

}
