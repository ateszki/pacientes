<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanesPrepaga extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('planes_prepaga', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('prepaga_id')->unsigned();
			$table->integer('plan_cobertura_id')->unsigned();
			$table->string('codigo',20);
			$table->string('descripcion',50);
			$table->integer('lista_precios_id')->unsigned();
			$table->integer('lista_basica_id')->unsigned();
			$table->boolean('requiere_bonos')->default(false);
			$table->boolean('requiere_autorizacion')->default(false);
			$table->boolean('requiere_odontograma')->default(false);
			$table->boolean('requiere_planilla_aparate')->default(false);
			$table->boolean('requiere_planilla_propia')->default(false);
			$table->boolean('requiere_planilla_baja')->default(false);
			$table->text('observaciones')->nullable;
			$table->boolean('habilitado')->default(true);
			$table->timestamps();
			$table->foreing('prepaga_id')->references('id')->on('prepagas');
			$table->foreing('plan_cobertura_id')->references('id')->on('planes_cobertura');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('planes_prepaga');
	}

}
