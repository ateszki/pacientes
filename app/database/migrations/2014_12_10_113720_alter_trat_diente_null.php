<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTratDienteNull extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tratamientos', function(Blueprint $table)
		{
			DB::statement("alter table tratamientos modify pieza_dental_id integer unsigned null");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tratamientos', function(Blueprint $table)
		{
			DB::statement("alter table tratamientos modify pieza_dental_id integer unsigned ");
		});
	}

}
