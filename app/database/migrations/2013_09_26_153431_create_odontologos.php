<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOdontologos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('odontologos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre',128);
			$table->string('apellido',128);
			$table->string('matricula');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('odontologos');
	}

}
