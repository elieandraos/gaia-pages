<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ComponentPageTranslations extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('component_page_translations', function(Blueprint $table)
		{
			$table->increments('id');
			
			//Translatable attributes
			$table->string('value');
			$table->text('params');
		    // Translatable attributes

			$table->integer('component_page_id')->unsigned()->index();
		    $table->foreign('component_page_id')->references('id')->on('component_page')->onDelete('cascade');

		    $table->integer('locale_id')->unsigned()->index();
		    $table->foreign('locale_id')->references('id')->on('locales')->onDelete('cascade');

		    $table->unique(['component_page_id', 'locale_id']);
		    
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
		Schema::drop('component_page_translations');
	}

}
