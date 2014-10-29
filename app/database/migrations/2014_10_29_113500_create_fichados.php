<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFichados extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fichados', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('fecha_emision');
			$table->date('fecha_auditoria');
			$table->char('tipo_fichado',1);
			$table->integer('paciente_id')->unsigned();
			$table->integer('centro_odontologo_especialidad_id')->unsigned();
			$table->integer('user_id_emision')->unsigned();
			$table->timestamps();
			$table->foreign('paciente_id')->references('id')->on('pacientes');
			$table->foreign('centro_odontologo_especialidad_id')->references('id')->on('centros_odontologos_especialidades');
			$table->foreign('user_id_emision')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fichados');
	}

}
