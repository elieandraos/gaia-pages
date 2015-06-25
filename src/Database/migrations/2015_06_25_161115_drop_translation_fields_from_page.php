<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropTranslationFieldsFromPage extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('page', function(Blueprint $table)
		{
			$table->dropColumn('title');
			$table->dropColumn('slug');
			$table->dropColumn('description');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('page', function(Blueprint $table)
		{
			$table->string('title');
			$table->string('slug');
			$table->text('description');
		});
	}

}
