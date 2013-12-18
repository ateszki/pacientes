<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsuarios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->string('username',50)->unique();
			$table->string('session_key',20)->nullable();
			$table->dateTime('session_expira')->nullable();
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
			$table->dropColumn('session_key');
			$table->dropColumn('session_expira');
			$table->dropUnique('users_username_unique');
			$table->dropColumn('username');
		});
	}

}
