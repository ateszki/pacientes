<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanesCobertura extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('planes_cobertura', function(Blueprint $table)
		{
			$table->increments("id");
			$table->string('codigo',20);
			$table->string('descripcion',50);
			$table->text('observaciones')->nullable();
			$table->boolean('habilitado')->default(true);	
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('planes_cobertura');
	}

}
