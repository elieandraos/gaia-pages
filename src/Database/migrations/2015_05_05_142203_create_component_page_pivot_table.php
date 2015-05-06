<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentPagePivotTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('component_page', function(Blueprint $table)
		{
			$table->integer('component_id')->unsigned()->index();
			$table->foreign('component_id')->references('id')->on('component')->onDelete('cascade');
			$table->integer('page_id')->unsigned()->index();
			$table->foreign('page_id')->references('id')->on('page')->onDelete('cascade');
			$table->string('value');
			$table->text('params');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('component_page');
	}

}
