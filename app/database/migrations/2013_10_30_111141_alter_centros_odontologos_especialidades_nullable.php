<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCentrosOdontologosEspecialidadesNullable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('centros_odontologos_especialidades', function(Blueprint $table)
		{
			DB::update(DB::raw("ALTER TABLE `centros_odontologos_especialidades` modify `consultorio_id` int(10) UNSIGNED NULL;"));	
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('centros_odontologos_especialidades', function(Blueprint $table)
		{
			DB::update(DB::raw("ALTER TABLE `centros_odontologos_especialidades` modify `consultorio_id` int(10) UNSIGNED NOT NULL;"));	
			//
		});
	}

}
