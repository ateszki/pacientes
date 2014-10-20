<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRolessUnique extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('roles', function(Blueprint $table)
		{
			$table->string('observaciones',255)->nullable();
			$table->unique('role');
			DB::statement('ALTER TABLE `roles` CHANGE `controller` `controller` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, CHANGE `methods` `methods` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL;');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('roles', function(Blueprint $table)
		{
			$table->dropColumn('observaciones');
			$table->dropUnique('roles_role_unique');
			DB::statement("update roles set `methods` = '' where `methods` is null");
			DB::statement("update roles set `controller` = '' where `controller` is null");
			DB::statement('ALTER TABLE `roles` CHANGE `controller` `controller` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, CHANGE `methods` `methods` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;');
		});
	}

}
