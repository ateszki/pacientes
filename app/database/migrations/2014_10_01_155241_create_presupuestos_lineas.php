<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresupuestosLineas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('presupuestos_lineas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('presupuesto_id')->unsigned();
			$table->integer('alternativa');
			$table->integer('nomenclador_id')->unsigned();
			$table->integer('pieza_dental_id')->unsigned()->nullable();
			$table->string('caras',5)->nullable();
			$table->boolean('aprobado')->default(false);
			$table->decimal('importe',10,2);
			$table->timestamps();
			$table->foreign('presupuesto_id')->references('id')->on('presupuestos');
			$table->foreign('nomenclador_id')->references('id')->on('nomencladores');
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
		Schema::drop('presupuestos_lineas');
	}

}
