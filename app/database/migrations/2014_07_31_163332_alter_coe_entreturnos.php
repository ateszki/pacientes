<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCoeEntreturnos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('centros_odontologos_especialidades', function(Blueprint $table)
		{
			$table->string('entreturnos_desde',4)->nullable();
			$table->string('entreturnos_hasta',4)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('centros_odontologos_especialidades', function(Blueprint $table)
		{
			$table->dropColumn('entreturnos_desde');
			$table->dropColumn('entreturnos_hasta');
		});
	}

}
