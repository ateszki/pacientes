<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMotivosTurnos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('motivos_turnos', function(Blueprint $table)
		{
			DB::update('ALTER TABLE `motivos_turnos` MODIFY `motivo` VARCHAR(25)');			
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
			DB::update('ALTER TABLE `motivos_turnos` MODIFY `motivo` VARCHAR(255)');			
		});
	}

}
