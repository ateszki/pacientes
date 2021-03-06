<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPlanesCoberturaUnique extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('planes_cobertura', function(Blueprint $table)
		{
			$table->unique('codigo');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('planes_cobertura', function(Blueprint $table)
		{
			$table->dropUnique('codigo_unique');
		});
	}

}
