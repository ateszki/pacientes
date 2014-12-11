<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCierresCajas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cierres_cajas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('caja_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->date('fecha');
			$table->time('hora');
			$table->timestamps();
			$table->foreign('caja_id')->references('id')->on('cajas');
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
		Schema::drop('cierres_cajas');
	}

}
