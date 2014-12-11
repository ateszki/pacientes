<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCierresCajasItems extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cierres_cajas_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cierres_cajas_id')->unsigned();
			$table->integer('medios_pago_caja_id')->unsigned();
			$table->decimal('importe',18,2);
			$table->timestamps();
			$table->foreign('cierres_cajas_id')->references('id')->on('cierres_cajas');
			$table->foreign('medios_pago_caja_id')->references('id')->on('medios_pago_caja');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cierres_cajas_items');
	}

}
