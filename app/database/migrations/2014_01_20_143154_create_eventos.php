<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('eventos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->bigInteger('modelo_id');
			$table->string('modelo');
			$table->string('tabla');
			$table->string('query');
			$table->integer('user_id')->unsigned();
			$table->string('usuario');
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('eventos');
	}

}
