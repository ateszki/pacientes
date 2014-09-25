<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLpnDefaults extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('listas_precios_nomenclador', function(Blueprint $table)
		{
			DB::statement("ALTER TABLE `listas_precios_nomenclador` CHANGE `precio` `precio` DECIMAL(10,2) NOT NULL DEFAULT '0'");
			DB::statement("ALTER TABLE `listas_precios_nomenclador` CHANGE `precio_fuera_rango` `precio_fuera_rango` DECIMAL(10,2) NULL DEFAULT '0'");
			DB::statement("ALTER TABLE `listas_precios_nomenclador` CHANGE `edad_coseguro_desde` `edad_coseguro_desde` INT(11) NULL DEFAULT '0';");
			DB::statement("ALTER TABLE `listas_precios_nomenclador` CHANGE `edad_coseguro_hasta` `edad_coseguro_hasta` INT(11) NULL DEFAULT '110';");
			DB::statement("ALTER TABLE `listas_precios_nomenclador` CHANGE `grupos_dentales_id` `grupos_dentales_id` INT(10) UNSIGNED NULL DEFAULT '10';");
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
			DB::statement("ALTER TABLE `listas_precios_nomenclador` CHANGE `precio` `precio` DECIMAL(10,2) NOT NULL ");
			DB::statement("ALTER TABLE `listas_precios_nomenclador` CHANGE `precio_fuera_rango` `precio_fuera_rango` DECIMAL(10,2) NOT NULL NULL");
			DB::statement("ALTER TABLE `listas_precios_nomenclador` CHANGE `edad_coseguro_desde` `edad_coseguro_desde` INT(11) NULL DEFAULT NULL;");
			DB::statement("ALTER TABLE `listas_precios_nomenclador` CHANGE `edad_coseguro_hasta` `edad_coseguro_hasta` INT(11) NULL DEFAULT NULL;");
			DB::statement("ALTER TABLE `listas_precios_nomenclador` CHANGE `grupos_dentales_id` `grupos_dentales_id` INT(10) UNSIGNED NULL DEFAULT NULL;");
		});
	}

}
