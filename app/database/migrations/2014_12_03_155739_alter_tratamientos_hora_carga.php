<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTratamientosHoraCarga extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tratamientos', function(Blueprint $table)
		{
			$table->time('hora_carga')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tratamientos', function(Blueprint $table)
		{
			$table->dropColumn('hora_carga');
		});
	}

}
