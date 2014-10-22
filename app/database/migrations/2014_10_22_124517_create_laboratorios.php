<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaboratorios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('laboratorios', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('codigo',20);
			$table->string('razon_social',50);
			$table->char('cuit',11)->nullable();
			$table->string('domicilio',50)->nullable();
			$table->string('localidad',50)->nullable();
			$table->integer('provincia_id')->unsigned();
			$table->integer('pais_id')->unsigned();
			$table->string('codigopostal',8)->nullable();
			$table->string('telefono',50)->nullable();
			$table->string('telefono2',50)->nullable();
			$table->string('email',254)->nullable();
			$table->integer('iva_id')->unsigned();
			$table->date('fecha_baja')->nullable();
			$table->text('observaciones')->nullable();
			$table->timestamps();
			$table->unique('codigo');
			$table->foreign('provincia_id')->references('id')->on('provincias');
			$table->foreign('pais_id')->references('id')->on('paises');
			$table->foreign('iva_id')->references('id')->on('iva');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('laboratorios');
	}

}
