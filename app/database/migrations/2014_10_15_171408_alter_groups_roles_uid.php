<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterGroupsRolesUid extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('group_role', function(Blueprint $table)
		{
			$table->dropForeign('group_role_user_id_foreign');
			$table->dropColumn('user_id');
			$table->integer('group_id')->unsigned();
			$table->foreign('group_id')->references('id')->on('groups');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('group_role', function(Blueprint $table)
		{
			$table->dropForeign('group_role_group_id_foreign');
			$table->dropColumn('group_id');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('groups');
			//
		});
	}

}
