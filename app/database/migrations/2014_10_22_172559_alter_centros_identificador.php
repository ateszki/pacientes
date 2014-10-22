<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCentrosIdentificador extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('centros', function(Blueprint $table)
		{
			$table->char('identificador',1)->default('X');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('centros', function(Blueprint $table)
		{
			$table->dropColumn(array('identificador'));
		});
	}

}
