<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEventosQuerySize extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('eventos', function(Blueprint $table)
		{
			DB::statement("ALTER TABLE `eventos` CHANGE `query` `query` VARCHAR(8000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('eventos', function(Blueprint $table)
		{
			//
			DB::statement("ALTER TABLE `eventos` CHANGE `query` `query` VARCHAR(8000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;");
		});
	}

}
