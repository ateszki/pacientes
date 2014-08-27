<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCtactesUniPresu extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ctactes', function(Blueprint $table)
		{
			$table->char('tipo',2);
			$table->dropColumn('presupuesto_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ctactes', function(Blueprint $table)
		{
			$table->dropColumn('tipo');
			$table->integer('presupuesto_id')->unsigned()->nullable();
		});
	}

}
