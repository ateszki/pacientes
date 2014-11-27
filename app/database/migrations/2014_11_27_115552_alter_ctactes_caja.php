<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCtactesCaja extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ctactes', function(Blueprint $table)
		{
			$table->integer('caja_id')->unsigned()->nullable();
			$table->foreign('caja_id')->references('id')->on('cajas');
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
			$table->dropForeign('ctactes_caja_id_foreign');
			$table->dropColumn('caja_id');
		});
	}

}
