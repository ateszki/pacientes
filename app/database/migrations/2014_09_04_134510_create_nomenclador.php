<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNomenclador extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nomencladores', function(Blueprint $table)
		{
			$table->increments('id');
			$table->char('codigo',8)->unique();
			$table->string("descripcion",50);
			$table->integer("edad_desde")->nullable();
			$table->integer("edad_hasta")->nullable();
			$table->char("nivel_auditoria",1)->nullable();
			$table->boolean('requiere_pieza')->default(false);
			$table->boolean('requiere_cara')->default(false);
			$table->boolean('requiere_sector')->default(false);
			$table->boolean('requiere_pilar')->default(false);
			$table->boolean('multiples_piezas')->default(false);
			$table->integer('duracion_estimada')->nullable();
			$table->boolean('paso_intermedio')->default(false);
			$table->boolean('genera_odontograma')->default(false);
			$table->char("item_bas",15)->nullable();
			$table->boolean('figura_odontograma')->default(false);
			$table->string('imagen_odontograma_anterior',50)->nullable();
			$table->string('imagen_odontograma_arealizar',50)->nullable();
			$table->boolean('habilitado')->default(true);
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
		Schema::drop('nomencladores');	
	}

}
