<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacteMovimientosCajas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('movimientos_cajas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('caja_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->char('ingreso_egreso',1);
			$table->date('fecha');
			$table->time('hora');
			$table->decimal('importe',18,2);
			$table->integer('ctacte_id')->unsigned()->nullable();
			$table->string('observaciones',255)->nullable();
			$table->integer('caja_ref_id')->unsigned()->nullable();
			$table->timestamps();
			$table->foreign('caja_id')->references('id')->on('cajas');
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('ctacte_id')->references('id')->on('ctactes');
			$table->foreign('caja_ref_id')->references('id')->on('cajas');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('movimientos_cajas');
	}

}
