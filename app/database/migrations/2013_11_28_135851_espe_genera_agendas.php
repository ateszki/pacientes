<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EspeGeneraAgendas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('especialidades', function(Blueprint $table)
		{
			$table->boolean("genera_agendas")->default(true);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('especialidades', function(Blueprint $table)
		{
			$table->dropColumn("genera_agendas");
		});
	}

}
