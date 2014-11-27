<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCajasRename extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cajas', function(Blueprint $table)
		{
			$table->renameColumn('controllador_fiscal','controlador_fiscal');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cajas', function(Blueprint $table)
		{
			$table->renameColumn('controlador_fiscal','controllador_fiscal');
			//
		});
	}

}
