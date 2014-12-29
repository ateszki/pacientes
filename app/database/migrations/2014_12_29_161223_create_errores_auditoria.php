<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateErroresAuditoria extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('codigo_errores_auditoria', function(Blueprint $table)
		{
			$table->increments('id');
			$table->char('codigo')->unique();
			$table->string('descripcion');
			$table->timestamps();
		});
		Schema::create('errores_auditoria', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tratamiento_id')->unsigned();
			$table->integer('codigo_errores_auditoria_id')->unsigned();
			$table->foreign('tratamiento_id')->references('id')->on('tratamientos');
			$table->foreign('codigo_errores_auditoria_id')->references('id')->on('codigo_errores_auditoria');
			$table->unique(array('tratamiento_id','codigo_errores_auditoria_id'),'unique_trat_cod_err_aud');
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
		Schema::drop('errores_auditoria');
		Schema::drop('codigo_errores_auditoria');
	}

}
