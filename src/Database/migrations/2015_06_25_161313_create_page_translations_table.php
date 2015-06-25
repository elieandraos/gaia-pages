<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('page_translations', function(Blueprint $table)
		{
			$table->increments('id');
			//Translatable attributes
			$table->string('title');
			$table->string('slug');
			$table->text('description');
			// Translatable attributes

			$table->integer('page_id')->unsigned()->index();
		    $table->foreign('page_id')->references('id')->on('page')->onDelete('cascade');

		    $table->integer('locale_id')->unsigned()->index();
		    $table->foreign('locale_id')->references('id')->on('locales')->onDelete('cascade');

		    $table->unique(['page_id', 'locale_id']);
		    
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('page_translations');
	}

}
