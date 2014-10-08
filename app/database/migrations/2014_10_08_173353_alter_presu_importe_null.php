<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPresuImporteNull extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('presupuestos', function(Blueprint $table)
		{
			DB::statement("ALTER TABLE `presupuestos` CHANGE `importe_bruto` `importe_bruto` DECIMAL(10,2) NULL DEFAULT '0.00', CHANGE `importe_neto` `importe_neto` DECIMAL(10,2) NULL DEFAULT '0.00';");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('presupuestos', function(Blueprint $table)
		{
			DB::statement("ALTER TABLE `presupuestos` CHANGE `importe_bruto` `importe_bruto` DECIMAL(10,2) NOT NULL DEFAULT '0.00', CHANGE `importe_neto` `importe_neto` DECIMAL(10,2) NOT NULL DEFAULT '0.00';");	
		});
	}

}
