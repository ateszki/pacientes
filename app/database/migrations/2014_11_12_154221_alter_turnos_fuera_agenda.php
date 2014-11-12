<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTurnosFueraAgenda extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('turnos', function(Blueprint $table)
		{
			$table->boolean('fuera_de_agenda')->default(false);
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
			$table->dropColumn('fuera_de_agenda');
		});
	}

}
