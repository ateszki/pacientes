<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueMatricula extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('odontologos', function(Blueprint $table)
		{
			$table->unique('matricula');
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
			$table->dropUnique('odontologos_matricula_unique');
		});
	}

}
