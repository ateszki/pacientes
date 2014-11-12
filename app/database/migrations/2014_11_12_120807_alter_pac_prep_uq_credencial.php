<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPacPrepUqCredencial extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('paciente_prepaga', function(Blueprint $table)
		{
			$table->unique(array('prepaga_id','numero_credencial'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('paciente_prepaga', function(Blueprint $table)
		{
			$table->dropUnique('paciente_prepaga_prepaga_id_numero_credencial_unique');
		});
	}

}
