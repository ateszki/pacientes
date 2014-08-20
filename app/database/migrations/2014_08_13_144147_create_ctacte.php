<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCtacte extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ctactes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('paciente_prepaga_id')->unsigned();
			$table->char('tipo_movimiento',2);// ( contado o financiado )
			$table->char('tipo_cbte',2);//FA,FB,RC
			$table->char('prefijo_cbte',4);
			$table->char('nro_cbte',8);
			$table->date('fecha');
			$table->integer('referencia')->unsigned()->nullable();
			$table->integer('presupuesto_id')->unsigned()->nullable();
			$table->decimal('importe_bruto',18,2);
			$table->decimal('porc_bonificacion',3,2)->nullable();
			$table->decimal('importe_neto',18,2);
			$table->decimal('importe_iva',18,2);
			$table->integer('user_id')->unsigned();
			$table->integer('centro_odontologo_especialidad_id')->unsigned();
			$table->date('fecha_transferencia_bas')->nullable();
			$table->char('ticket',13)->nullable();
			$table->date('fecha_ticket')->nullable();
			$table->boolean('print_ok')->default(false);
			$table->string('impresora_fiscal',15)->nullable();
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('centro_odontologo_especialidad_id')->references('id')->on('centros_odontologos_especialidades');
			$table->foreign('paciente_prepaga_id')->references('id')->on('paciente_prepaga');
			$table->foreign('referencia')->references('id')->on('ctactes');
			$table->unique(array('tipo_cbte','prefijo_cbte','nro_cbte'));
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
