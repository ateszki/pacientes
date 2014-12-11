<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMovCajaCierre extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('movimientos_cajas', function(Blueprint $table)
		{
			$table->integer('cierres_cajas_id')->unsigned()->nullable();
			$table->foreign('cierres_cajas_id')->references('id')->on('cierres_cajas');
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
			$table->dropForeign('movimientos_cajas_cierres_cajas_id_foreign');
			$table->dropColumn('cierres_cajas_id');
		});
	}

}
