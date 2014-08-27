<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCtactesFacVarios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ctactes_fac_lin', function(Blueprint $table)
		{
			$table->integer('presupuesto_id')->unsigned()->nullable();
			$table->decimal('tasa_iva',4,2);
			$table->decimal('importe_iva',18,2);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ctactes_fac_lin', function(Blueprint $table)
		{
			$table->dropColumn('presupuesto_id','tasa_iv','importe_iva');
		});
	}

}
