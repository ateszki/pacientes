<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FksPacienteObs extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('paciente_observaciones', function(Blueprint $table)
		{
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('paciente_id')->references('id')->on('pacientes');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('paciente_observaciones', function(Blueprint $table)
		{
			$table->dropForeign('paciente_observaciones_user_id_foreign');
			$table->dropForeign('paciente_observaciones_paciente_id_foreign');
		});
	}

}
