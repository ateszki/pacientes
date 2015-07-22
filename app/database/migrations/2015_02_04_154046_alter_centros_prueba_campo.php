<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCentrosPruebaCampo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('centros', function(Blueprint $table)
		{
//			$table->boolean('cochera')->default(true);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('centros', function(Blueprint $table)
		{
//			$table->dropColumn('cochera');
		});
	}

}
