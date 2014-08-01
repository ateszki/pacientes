<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeriados extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('feriados', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('fecha');
			$table->string('feriado',50);
			$table->timestamps();
			$table->unique('fecha');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('feriados');
	}

}
