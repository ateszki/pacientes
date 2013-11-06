<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultorios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('consultorios', function(Blueprint $table)
		{
			$table->increments("id");
			$table->integer("numero");
			$table->integer("centro_id")->unsigned();
			$table->string("descripcion",100)->nullable();
			$table->timestamps();
			$table->unique(array('numero','centro_id'));
			$table->foreign('centro_id')->references('id')->on('centros');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
			Schema::drop('consultorios');
	}

}
