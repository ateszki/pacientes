<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenciasFichados extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('referencias_fichados', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descripcion',50);
			$table->boolean('requiere_pieza');
			$table->boolean('requiere_cara');
			$table->boolean('requiere_sector');
			$table->boolean('multiples_piezas');
			$table->string('imagen_odontograma_anterior')->nullable();
			$table->string('imagen_odontograma_arealizar')->nullable();
			$table->char('extension_imagen',3); 
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
		Schema::drop('referencias_fichados');
	}

}
