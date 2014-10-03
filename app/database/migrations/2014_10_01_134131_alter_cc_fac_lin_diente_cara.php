<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCcFacLinDienteCara extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ctactes_fac_lin', function(Blueprint $table)
		{
			$table->integer('piezas_dentales_id')->unsigned()->nullable();
			$table->string('caras',5)->nullable();
			$table->foreign('piezas_dentales_id')->references('id')->on('piezas_dentales');
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
			$table->dropForeign('ctactes_fac_lin_piezas_dentales_id_foreign');
			$table->dropColumn(array('piezas_dentales_id','caras'));
		});
	}

}
