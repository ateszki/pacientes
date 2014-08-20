<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCtacteRecLin extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ctactes_rec_lin', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('ctacte_id')->unsigned();
			$table->string('numero',20)->nullable();
			$table->char('codigo_banco',3)->nullable();
			$table->date('fecha_acreditacion')->nullable();
			$table->char('codigo_tarjeta',2)->nullable();
			$table->char('codigo_plan',3)->nullable();
			$table->string('numero_cupon',25)->nullable();
			$table->string('codigo_aprobacion',25)->nullable();
			$table->decimal('tipo_cambio',18,2)->nullable();
			$table->decimal('importe',18,2)->nullable();
			$table->timestamps();
			$table->foreign('ctacte_id')->references('id')->on('ctactes');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ctactes');
	}

}
