<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenTrabajoItems extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ordenes_trabajo_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('orden_trabajo_id')->unsigned();
			$table->integer('presupuesto_linea_id')->unsigned();
			$table->string('motivo',25)->nullable();
			$table->integer('nomenclador_paso_id')->unsigned();
			$table->string('autorizado_por',25)->nullable();
			$table->char('tipo_cubeta',1)->nullable();
			$table->date('fecha_devolucion')->nullable();
			$table->integer('user_id_recibido')->unsigned()->nullable();
			$table->string('remito_devolucion',25)->nullable();
			$table->string('estado_devolucion',25)->nullable();
			$table->decimal('precio',18,2)->nullable();
			$table->foreign('orden_trabajo_id','OT_foreign')->references('id')->on('ordenes_trabajo');
			$table->foreign('presupuesto_linea_id','PL_foreign')->references('id')->on('presupuestos_lineas');
			$table->foreign('nomenclador_paso_id','NOMENCLA_foreign')->references('id')->on('nomencladores_pasos');
			$table->foreign('user_id_recibido','USER_foreign')->references('id')->on('users');
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
		Schema::drop('ordenes_trabajo_items');
	}

}
