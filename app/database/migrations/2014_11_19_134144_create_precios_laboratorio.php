<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreciosLaboratorio extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('listas_precios_laboratorio', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('laboratorio_id')->unsigned();
			$table->integer('nomenclador_id')->unsigned();
			$table->decimal('precio',18,2);
			$table->timestamps();
			$table->foreign('laboratorio_id')->references('id')->on('laboratorios');
			$table->foreign('nomenclador_id')->references('id')->on('nomencladores');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('listas_precios_laboratorio');
	}

}
