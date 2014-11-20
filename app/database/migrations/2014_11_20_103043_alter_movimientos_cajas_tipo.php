<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMovimientosCajasTipo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('movimientos_cajas', function(Blueprint $table)
		{
			$table->integer('tipo_mov_caja_id')->unsigned();
			$table->foreign('tipo_mov_caja_id')->references('id')->on('tipo_mov_cajas');
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
			$table->dropForeign('movimientos_cajas_tipo_mov_caja_id_foreign');
			$table->dropColumn('tipo_mov_caja_id');
		});
	}

}
