<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCajasCentroPdv extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cajas', function(Blueprint $table)
		{
			$table->integer('centro_id')->unsigned();
			$table->char('punto_de_venta',4)->nullable();
			$table->foreign('centro_id')->references('id')->on('centros');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cajas', function(Blueprint $table)
		{
			$table->dropForeign('cajas_centro_id_foreing');
			$table->dropColumn(array('centro_id','punto_de_venta'));
		});
	}

}
