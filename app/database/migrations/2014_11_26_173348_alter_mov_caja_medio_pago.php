<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMovCajaMedioPago extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('movimientos_cajas', function(Blueprint $table)
		{
			$table->integer('medios_pago_caja_id')->unsigned();
			$table->foreign('medios_pago_caja_id')->references('id')->on('medios_pago_caja');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('movimientos_cajas', function(Blueprint $table)
		{
			$table->dropForeign('movimientos_cajas_medios_pago_caja_id_foreign');
			$table->dropColumn('medios_pago_caja_id');
		});
	}

}
