<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposDentalesPiezas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('grupos_dentales_piezas_dentales', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('grupos_dentales_id')->unsigned();
			$table->integer('piezas_dentales_id')->unsigned();
			$table->timestamps();
			$table->foreign('grupos_dentales_id')->references('id')->on('grupos_dentales');
			$table->foreign('piezas_dentales_id')->references('id')->on('piezas_dentales');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('grupos_dentales_piezas_dentales');
	}

}
