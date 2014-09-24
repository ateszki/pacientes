<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLpnObservaciones extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('listas_precios_nomenclador', function(Blueprint $table)
		{
			DB::statement('ALTER TABLE `listas_precios_nomenclador` CHANGE `observaciones` `observaciones` TEXT NULL;');
    			DB::statement("UPDATE `listas_precios_nomenclador` SET `observaciones` = NULL WHERE `observaciones` = '';");
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
    			DB::statement("UPDATE `listas_precios_nomenclador` SET `observaciones` = '' WHERE `observaciones` = NULL;");
			DB::statement('ALTER TABLE `listas_precios_nomenclador` CHANGE `observaciones` `observaciones` TEXT NOT NULL;');
			//
		});
	}

}
