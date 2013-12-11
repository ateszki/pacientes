<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTurnoPacientePrep extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('turnos', function(Blueprint $table)
		{
			$table->dropColumn("prepaga_id");
			$table->integer("paciente_prepaga_id")->unsigned()->nullable();
			$table->foreign("paciente_prepaga_id")->references('id')->on('paciente_prepaga');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('turnos', function(Blueprint $table)
		{
			$table->integer("prepaga_id")->unsigned()->nullable();
			$table->dropForeign("turnos_paciente_prepaga_id_foreign");
			$table->dropColumn("paciente_prepaga_id");
		});
	}

}
