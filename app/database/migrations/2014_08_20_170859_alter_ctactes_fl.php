<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCtactesFl extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ctactes_fac_lin', function(Blueprint $table)
		{
			$table->dropColumn('item_id');
			$table->char('tipo',1);
			$table->string('codigo',20);
			$table->string('descripcion',100);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ctactes_fac_lin', function(Blueprint $table)
		{
			$table->ineger('item_id')->unsigned();
			$table->dropColumn('tipo');
			$table->dropColumn('codigo');
			$table->dropColumn('descripcion');
		});
	}

}
