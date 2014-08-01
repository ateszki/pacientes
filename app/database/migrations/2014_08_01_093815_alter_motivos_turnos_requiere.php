<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMotivosTurnosRequiere extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('motivos_turnos', function(Blueprint $table)
		{
			$table->boolean('requiere_pieza')->default(false);
			$table->boolean('requiere_derivador')->default(false);
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
			$table->dropColumn('requiere_pieza');
			$table->dropColumn('requiere_derivador');
		});
	}

}
