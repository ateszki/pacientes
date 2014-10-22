<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNomenclaPasos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nomencladores_pasos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('nomenclador_id')->unsigned();
			$table->integer('nomenclador_paso_id')->unsigned();
			$table->integer('numero_etapa')->nullable();
			$table->timestamps();
			$table->foreign('nomenclador_id','nomencla_id_foreign')->references('id')->on('nomencladores');
			$table->foreign('nomenclador_paso_id','nomencla_paso_foreign')->references('id')->on('nomencladores');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('nomencladores_pasos');
	}

}
