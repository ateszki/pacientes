<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPrecioLab extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('listas_precios_laboratorio', function(Blueprint $table)
		{
			$table->integer('nomenclador_paso_id')->unsigned();
			$table->foreign('nomenclador_paso_id')->references('id')->on('nomencladores_pasos');
			$table->dropForeign('listas_precios_laboratorio_nomenclador_id_foreign');
			$table->dropColumn('nomenclador_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('listas_precios_laboratorio', function(Blueprint $table)
		{
			$table->integer('nomenclador__id')->unsigned();
			$table->foreign('nomenclador_id')->references('id')->on('nomencladores');
			$table->dropForeign('listas_precios_laboratorio_nomenclador_paso_id_foreign');
			$table->dropColumn('nomenclador_paso_id');
		});
	}

}
