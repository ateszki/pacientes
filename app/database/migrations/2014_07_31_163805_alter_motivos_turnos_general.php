<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMotivosTurnosGeneral extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('motivos_turnos', function(Blueprint $table)
		{
			$table->boolean('general')->default(false);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('motivos_turnos', function(Blueprint $table)
		{
			$table->dropColumn('general');
		});
	}

}
