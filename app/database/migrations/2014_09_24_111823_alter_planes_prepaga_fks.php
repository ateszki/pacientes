<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPlanesPrepagaFks extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('planes_prepaga', function(Blueprint $table)
		{
			$table->foreign('lista_basica_id')->references('id')->on('listas_precios');
			$table->foreign('lista_precios_id')->references('id')->on('listas_precios');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('planes_prepaga', function(Blueprint $table)
		{
			$table->dropForeign('planes_prepaga_lista_basica_id_foreign');
			$table->dropForeign('planes_prepaga_lista_precios_id_foreign');
		});
	}

}
