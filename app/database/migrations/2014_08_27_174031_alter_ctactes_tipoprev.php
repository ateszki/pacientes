<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCtactesTipoprev extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ctactes', function(Blueprint $table)
		{
			$table->renameColumn('tipo', 'tipo_prev');
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
			$table->renameColumn('tipo_prev', 'tipo');
		});
	}

}
