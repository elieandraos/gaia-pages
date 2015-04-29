<?php

use Illuminate\Database\Seeder;
use App\Models\Template;

class TemplateTableSeeder extends Seeder {

	/**
	 * Description
	 * @return type
	 */
	public function run()
	{		
		$this->cleanUp();

		Template::create([
			"title" => "Default",
			"display" => "tabs"
		]);
	}

	/**
	 * truncates the table before seeding
	 * @return type
	 */
	private function cleanUp()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		DB::table('template')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}