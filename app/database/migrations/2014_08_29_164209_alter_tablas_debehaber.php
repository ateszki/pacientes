<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablasDebehaber extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tablas', function(Blueprint $table)
		{
			$table->char('debehaber',1)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tablas', function(Blueprint $table)
		{
			$table->dropColumn('debehaber');
		});
	}

}
