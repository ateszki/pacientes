<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModCenOdoEsp extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('centros_odontologos_especialidades', function(Blueprint $table)
		{
			$table->foreign('consultorio_id')->references('id')->on('consultorios');
			DB::update(DB::raw("create unique index ceo_unique on centros_odontologos_especialidades (centro_id, especialidad_id, odontologo_id, turno, dia_semana);"));
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
			$table->dropForeign('centros_odontologos_especialidades_consultorio_id_foreign');
			$table->dropUnique('ceo_unique');
		});
	}

}
