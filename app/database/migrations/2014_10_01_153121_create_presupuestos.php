<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresupuestos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('presupuestos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('fecha_emision');
			$table->integer('user_id_emision')->unsigned();
			$table->date('fecha_aprobacion')->nullable();
			$table->integer('user_id_aprobacion')->unsigned()->nullable();
			$table->integer('centro_odontologo_especialidad_id')->unsigned();
			$table->decimal('bonificacion',10,2)->nullable();
			$table->integer('paciente_prepaga_id')->unsigned();
			$table->decimal('importe_bruto',10,2)->default(0);
			$table->decimal('importe_neto',10,2)->default(0);
			$table->string('observaciones',512)->nullable();
			$table->timestamps();
			$table->foreign('user_id_emision')->references('id')->on('users');
			$table->foreign('user_id_aprobacion')->references('id')->on('users');
			$table->foreign('paciente_prepaga_id')->references('id')->on('paciente_prepaga');
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
		Schema::drop('presupuestos');
	}

}
