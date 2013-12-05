<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPacientePrepaga extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('paciente_prepaga', function(Blueprint $table)
		{
			$table->string('numero_credencial',30);
			$table->string('plan_cobertura',30);
			$table->date('fecha_alta');
			$table->date('fecha_baja')->nullable();
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
			$table->dropColumn('numeor_credencial');
			$table->dropColumn('plan_cobertura');
			$table->dropColumn('fecha_alta');
			$table->dropColumn('fecha_baja');
		});
	}

}
