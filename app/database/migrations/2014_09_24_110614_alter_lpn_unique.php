<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLpnUnique extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('listas_precios_nomenclador', function(Blueprint $table)
		{
			$table->unique(array('listas_precios_id','nomenclador_id'),'unique_lp_nom');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('listas_precios_nomenclador', function(Blueprint $table)
		{
			$table->dropUnique('unique_lp_nom');
		});
	}

}
