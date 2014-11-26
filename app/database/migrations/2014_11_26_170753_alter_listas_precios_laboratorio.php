<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterListasPreciosLaboratorio extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('listas_precios_laboratorio', function(Blueprint $table)
		{
			$table->unique(array('laboratorio_id','nomenclador_paso_id'),'labo_nome_unique');
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
			$table->dropunique('labo_nome_unique');
		});
	}

}
