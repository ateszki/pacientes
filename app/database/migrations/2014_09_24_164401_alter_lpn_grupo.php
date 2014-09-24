<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLpnGrupo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('listas_precios_nomenclador', function(Blueprint $table)
		{
			$table->decimal('precio_fuera_rango',10,2)->nullable();
			$table->integer('edad_coseguro_desde')->nullable();
			$table->integer('edad_coseguro_hasta')->nullable();
			$table->integer('grupos_dentales_id')->unsigned()->nullable();
			$table->foreign('grupos_dentales_id')->references('id')->on('grupos_dentales');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('listas_precios_nomenclador', function(Blueprint $table)
		{
			$table->dropForeign('listas_precios_nomenclador_grupos_dentales_id_foreign');
			$table->dropColum(array('precio_fuera_rango','edad_coseguro_desde','edad_coseguro_hasta','grupos_dentales_id'));
		});
	}

}
