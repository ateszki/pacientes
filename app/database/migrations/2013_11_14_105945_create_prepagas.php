<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrepagas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prepagas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('codigo',5);
			$table->string('razon_social',50);
			$table->string('denominacion_comercial',50);
			$table->string('cuit',11)->nullable();
			$table->string('domicilio',50)->nullable();
			$table->string('localidad',50)->nullable();
			$table->integer('provincia_id')->default(1)->unsigned();			
			$table->integer('pais_id')->default(1)->unsigned();	
			$table->string('codigopostal',8)->nullable();
			$table->string('telefono',50)->nullable();			
			$table->string('telefono2',50)->nullable();			
			$table->string('email',254)->nullable();			
			$table->integer('iva_id')->default(1)->unsigned();	
			$table->string('credencial_propia',1);		
			$table->string('presenta_padron',1);
			$table->dateTime('fecha_alta')->nullable();		
			$table->dateTime('fecha_baja')->nullable();
			$table->integer('condicion_venta_id')->unsigned();		
			$table->string('turnos_habilitados',1);
			$table->string('precios_bonificados',1);
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
		Schema::drop('prepagas');
	}

}
