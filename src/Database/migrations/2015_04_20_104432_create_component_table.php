<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('component', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->integer('order');
			$table->text('options');
			$table->integer('component_type_id')->unsigned();
			$table->foreign('component_type_id')
						->references('id')
						->on('component_type')
						->onDelete('cascade');
			$table->integer('section_id')->unsigned();
			$table->foreign('section_id')
						->references('id')
						->on('section')
						->onDelete('cascade');
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
		Schema::drop('component');
	}

}
