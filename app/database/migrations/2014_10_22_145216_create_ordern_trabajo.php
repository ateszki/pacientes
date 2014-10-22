<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdernTrabajo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ordenes_trabajo', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('laboratorio_id')->unsigned();
			$table->integer('presupuesto_id')->unsigned(); 
			$table->date('fecha_emision');
			$table->date('fecha_espera')->nullable();
			$table->integer('user_id_emision')->unsigned();
			$table->integer('centro_odontologo_especialidad_id')->unsigned();
			$table->text('observaciones')->nullable();
			$table->integer('ctactes_id_factura')->unsigned();
			$table->integer('ctactes_id_recibo')->unsigned();
			$table->foreign('laboratorio_id')->references('id')->on('laboratorios');
			$table->foreign('presupuesto_id')->references('id')->on('presupuestos');
			$table->foreign('user_id_emision')->references('id')->on('users');
			$table->foreign('ctactes_id_factura')->references('id')->on('ctactes');
			$table->foreign('ctactes_id_recibo')->references('id')->on('ctactes');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ordenes_trabajo');
	}

}
