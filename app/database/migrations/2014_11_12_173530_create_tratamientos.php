<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTratamientos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tratamientos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('turno_id')->unsigned();
			$table->integer('nomenclador_id')->unsigned();
			$table->integer('pieza_dental_id')->unsigned();
			$table->char('caras',5)->nullable();
			$table->decimal('valor',18,2)->nullable();
			$table->integer('user_id_carga')->unsigned();
			$table->date('fecha_carga');
			$table->char('resultado_auditoria',1)->nullable();
			$table->date('fecha_auditoria')->nullable();
			$table->integer('user_id_auditor')->unsigned()->nullable();
			$table->foreign('turno_id')->references('id')->on('turnos');
			$table->foreign('nomenclador_id')->references('id')->on('nomencladores');
			$table->foreign('pieza_dental_id')->references('id')->on('piezas_dentales');
			$table->foreign('user_id_carga')->references('id')->on('users');
			$table->foreign('user_id_auditor')->references('id')->on('users');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tratamientos');
	}

}
