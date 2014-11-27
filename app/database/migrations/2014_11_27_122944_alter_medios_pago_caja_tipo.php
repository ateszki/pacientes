<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMediosPagoCajaTipo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('medios_pago_caja', function(Blueprint $table)
		{
			$table->char('tipo',1)->default('E');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('medios_pago_caja', function(Blueprint $table)
		{
			$table->dropColumn('tipo');
		});
	}

}
