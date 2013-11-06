<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCentrosOdontologosEspecialidadesHorariosStr extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('centros_odontologos_especialidades', function(Blueprint $table)
		{
			DB::update(DB::raw("ALTER TABLE centros_odontologos_especialidades CHANGE horario_desde horario_desde varchar(4) NULL"));
			DB::update(DB::raw("ALTER TABLE centros_odontologos_especialidades CHANGE horario_hasta horario_hasta varchar(4) NULL"));
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
			DB::update(DB::raw("ALTER TABLE centros_odontologos_especialidades CHANGE horario_desde horario_desde time NULL"));
			DB::update(DB::raw("ALTER TABLE centros_odontologos_especialidades CHANGE horario_hasta horario_hasta time NULL"));
		});
	}

}
