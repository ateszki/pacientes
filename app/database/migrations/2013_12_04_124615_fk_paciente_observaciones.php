<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkPacienteObservaciones extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('observaciones_pacientes', function(Blueprint $table)
		{
			$table->foreign('tipo')->references('id')->on('tipo_observaciones');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('observaciones_pacientes', function(Blueprint $table)
		{
			$table->dropForeign('obervaciones_pacientes_tipo_foreign');
		});
	}

}
