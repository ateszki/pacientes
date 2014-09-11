<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterListasPreciosUnique extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('listas_precios', function(Blueprint $table)
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
		Schema::table('listas_precios', function(Blueprint $table)
		{
			$table->dropunique('codigo_unique');
		});
	}

}
