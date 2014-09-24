<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDientes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('piezas_dentales', function(Blueprint $table)
		{
			$table->increments('id');
			$table->char('diente',2);
			$table->string('descripcion',100)->nullable();
			$table->tinyInteger('sector');
			$table->boolean('permanente');
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
		Schema::drop('dientes');
	}

}
