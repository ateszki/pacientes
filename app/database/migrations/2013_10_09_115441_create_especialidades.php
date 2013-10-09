<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspecialidades extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('especialidades', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('especialidad',50);
			$table->smallInteger('lapso')->default(40);
			$table->smallInteger('valor')->default(5);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('especialidades');
	}

}
