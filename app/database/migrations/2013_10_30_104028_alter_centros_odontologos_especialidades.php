<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCentrosOdontologosEspecialidades extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('centros_odontologos_especialidades', function(Blueprint $table)
		{
			$table->string('dia_semana',10);
			$table->string('turno',1);
			$table->integer('consultorio_id')->unsigned();
			$table->time('horario_desde')->nullable();
			$table->time('horario_hasta')->nullable();
			$table->integer('duracion_turno')->nullable();
			$table->integer('cant_max_entreturnos')->nullable();
			$table->boolean('habilitado')->default(true);
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
			$table->dropColumn('dia_semana');
			$table->dropColumn('turno');
			$table->dropColumn('consultorio_id');
			$table->dropColumn('horario_desde');
			$table->dropColumn('horario_hasta');
			$table->dropColumn('duracion_turno');
			$table->dropColumn('cant_max_entreturnos');
			$table->dropColumn('habilitado');
		});
	}

}
