<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersEsquemaColor extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->integer('esquema_color_id')->unsigned()->nullable();
			$table->foreign('esquema_color_id')->references('id')->on('esquema_color');			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropForeign('users_esquema_color_id_foreign');
			$table->dropColumn(array('esquema_color_id'));
		});
	}

}
