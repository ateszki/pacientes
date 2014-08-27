<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCtactesUnique extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ctactes', function(Blueprint $table)
		{
			DB::statement('ALTER TABLE ctactes MODIFY prefijo_cbte char(4) NULL default NULL, MODIFY nro_cbte char(8) NULL default NULL ');
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
			DB::statement('ALTER TABLE ctactes MODIFY prefijo_cbte char(4) NOT NULL, MODIFY nro_cbte char(8) NOT NULL ');
			//
		});
	}

}
