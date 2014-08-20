<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCtacteFacLin extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ctactes_fac_lin', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('ctacte_id')->unsigned();
			$table->integer('item_id')->unsigned();
			$table->integer('cantidad');
			$table->decimal('precio',18,2);
			$table->decimal('importe',18,2);	
			$table->timestamps();
			$table->foreign('ctacte_id')->references('id')->on('ctactes');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ctactes');
	}

}
