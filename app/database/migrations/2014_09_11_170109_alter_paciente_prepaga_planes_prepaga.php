<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPacientePrepagaPlanesPrepaga extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('paciente_prepaga', function(Blueprint $table)
		{
			$table->integer('planes_prepaga_id')->unsigned();
			$table->dropColumn('plan_cobertura');
			$table->foreign('planes_prepaga_id')->references('id')->on('planes_prepaga');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('paciente_prepaga', function(Blueprint $table)
		{
			$table->dropColumn('planes_prepaga_id');
			$table->string('plan_cobertura',30);
			$table->dropForeign('paciente_prepaga_planes_prepaga_id_foreign');
		});
	}

}
