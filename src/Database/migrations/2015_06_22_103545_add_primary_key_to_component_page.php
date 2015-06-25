<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrimaryKeyToComponentPage extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('component_page', function(Blueprint $table)
		{
			$table->increments('id');
			$table->dropColumn('value');
			$table->dropColumn('params');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('component_page', function(Blueprint $table)
		{
			$table->dropColumn('id');
			$table->string('value');
			$table->text('params');
		});
	}

}
