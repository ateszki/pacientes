<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCtactesTipocbte extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ctactes', function(Blueprint $table)
		{
			DB::statement('ALTER TABLE ctactes MODIFY COLUMN tipo_cbte char(2) NULL');
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
			DB::statement('ALTER TABLE ctactes MODIFY COLUMN tipo_cbte char(2) NOT NULL');
			//
		});
	}

}
