<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeValueColumnTypeInComponentPageTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('component_page_translations', function(Blueprint $table)
		{
			 $table->text('value')->change();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('component_page_translations', function(Blueprint $table)
		{
			$table->string('value');
		});
	}

}
