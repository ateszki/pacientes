<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPlanesCoberturaEspecialidadUnique extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('planes_cobertura_especialidad', function(Blueprint $table)
		{
			$table->unique(array('planes_cobertura_id','especialidad_id'),'planes_cobertura_id_especialidad_id_unique');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('planes_cobertura_especialidad', function(Blueprint $table)
		{
			$table->dropUnique('planes_cobertura_id_especialidad_id_unique');
		});
	}

}
