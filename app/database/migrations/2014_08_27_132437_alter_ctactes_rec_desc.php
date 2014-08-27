<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCtactesRecDesc extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ctactes_rec_lin', function(Blueprint $table)
		{
			$table->string('descripcion',50)->nullable();
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
			$table->dropColumn('descripcion');
		});
	}

}
