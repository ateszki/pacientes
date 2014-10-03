<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLpnPrecFueraCob extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('listas_precios_nomenclador', function(Blueprint $table)
		{
			$table->decimal('precio_fuera_cobertura',10,2)->nullable()->default(0);
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
			$table->dropColumn('precio_fuera_cobertura');
		});
	}

}
