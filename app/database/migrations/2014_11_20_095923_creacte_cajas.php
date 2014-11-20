<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacteCajas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cajas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string("caja",100);
			$table->string("descripcion",255)->nullable();
			$table->string("controllador_fiscal",25)->nullable();
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
		Schema::drop('cajas');
	}

}
