<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NotNullableFields extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('odontologos', function(Blueprint $table)
		{
			DB::update(DB::raw("ALTER TABLE `odontologos` modify `sexo` varchar(1) NOT NULL;"));	
			DB::update(DB::raw("ALTER TABLE `odontologos` modify `fechaalta` date NOT NULL;"));	
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('odontologos', function(Blueprint $table)
		{
			DB::update(DB::raw("ALTER TABLE `odontologos` modify `sexo` varchar(1) NULL;"));	
			DB::update(DB::raw("ALTER TABLE `odontologos` modify `fechaalta` date NULL;"));	
		});
	}

}
