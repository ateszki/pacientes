<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEsquemaColor extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('esquema_color', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre',30)->unique();
			$table->string('shape',15);
			$table->string('text_box',15);
			$table->string('grid',15);
			$table->string('list_view',15);
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
		Schema::drop('esquema_color');
	}

}
