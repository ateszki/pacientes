<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFichadosItems extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fichados_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('fichado_id')->unsigned();
			$table->integer('referencia_fichado_id')->unsigned();
			$table->char('tipo_referencia',1);
			$table->integer('pieza_dental_id')->unsigned()->nullable();
			$table->string('caras',10)->nullable();
			$table->timestamps();
			$table->foreign('fichado_id')->references('id')->on('fichados');
			$table->foreign('referencia_fichado_id')->references('id')->on('referencias_fichados');
			$table->foreign('pieza_dental_id')->references('id')->on('piezas_dentales');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fichados_items');
	}

}
