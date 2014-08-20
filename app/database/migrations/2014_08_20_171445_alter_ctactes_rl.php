<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCtactesRl extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ctactes_rec_lin', function(Blueprint $table)
		{
			$table->renameColumn('numero', 'numero_cheque');
			$table->char('tipo',1)->default('E');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ctactes_rec_lin', function(Blueprint $table)
		{
			$table->dropColumn('tipo');
			$table->renameColumn('numero_cheque', 'numero');
		});
	}

}
