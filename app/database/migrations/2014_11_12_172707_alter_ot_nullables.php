<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOtNullables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ordenes_trabajo', function(Blueprint $table)
		{
			DB::statement("ALTER TABLE `ordenes_trabajo` CHANGE `ctactes_id_factura` `ctactes_id_factura` INT(10) UNSIGNED NULL DEFAULT NULL, CHANGE `ctactes_id_recibo` `ctactes_id_recibo` INT(10) UNSIGNED NULL DEFAULT NULL;");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ordenes_trabajo', function(Blueprint $table)
		{
			
		});
	}

}
