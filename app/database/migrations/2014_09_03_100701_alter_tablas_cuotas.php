<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablasCuotas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tablas', function(Blueprint $table)
		{
			$table->integer('cuotas')->nullable();
			$table->decimal('coeficiente',6,4)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tablas', function(Blueprint $table)
		{
			$table->dropColumn('cuotas');
			$table->dropColumn('coeficiente');
		});
	}

}
