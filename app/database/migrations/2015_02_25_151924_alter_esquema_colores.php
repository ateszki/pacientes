<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEsquemaColores extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('esquema_color', function(Blueprint $table)
		{
			$table->dropColumn('grid');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('esquema_colores', function(Blueprint $table)
		{
			$table->string('grid',15)->nullable();
		});
	}

}
