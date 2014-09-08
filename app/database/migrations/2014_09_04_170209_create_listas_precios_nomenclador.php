<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListasPreciosNomenclador extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('listas_precios_nomenclador', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('listas_precios_id')->unsigned();
			$table->integer('nomenclador_id')->unsigned();
			$table->decimal('precio',10,2);
			$table->boolean('requiere_autorizacion')->default(false);
			$table->boolean('requiere_odontograma')->default(false);
			$table->boolean('requiere_planilla_aparte')->default(false);
			$table->text('observaciones');
			$table->foreign('listas_precios_id')->references('id')->on('listas_precios');		
			$table->foreign('nomenclador_id')->references('id')->on('nomencladores');		
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
		Schema::drop('listas_precios_nomenclador');
	}

}
