<?php

use Illuminate\Database\Seeder;
use App\Models\ComponentType;

class ComponentTypeTableSeeder extends Seeder {

	/**
	 * Description
	 * @return type
	 */
	public function run()
	{		
		$this->cleanUp();

		ComponentType::create([
			"title" => "Text",
			"class_name" => "TextComponent",
			"caption" => "Generates a text (input) field for small content (few words).",
			"icon" => "fa fa-text-width"
		]);

		ComponentType::create([
			"title" => "Paragraph",
			"class_name" => "ParagraphComponent",
			"caption" => "Generates a textarea (input) field for larger content.",
			"icon"	=> "fa fa-align-justify"
		]);

		ComponentType::create([
			"title" => "Image",
			"class_name" => "ImageComponent",
			"caption" => "Generates an image upload field.",
			"icon"	=> "fa fa-picture-o"
		]);

		ComponentType::create([
			"title" => "Date Picker",
			"class_name" => "DatePickerComponent",
			"caption" => "Generates a date picker.",
			"icon"	=> "fa fa-calendar-o"
		]);

		ComponentType::create([
			"title" => "Check List",
			"class_name" => "CheckboxComponent",
			"caption" => "Generates a checkbox list (multiple choices).",
			"icon"	=> "fa fa-check-square-o"
		]);

		ComponentType::create([
			"title" => "Drop down",
			"class_name" => "DropdownComponent",
			"caption" => "Generates a dropdown (one choice).",
			"icon"	=> "fa fa-list"
		]);	

		ComponentType::create([
			"title" => "Radio List",
			"class_name" => "RadioComponent",
			"caption" => "Generates a radio list (one choice).",
			"icon"	=> "fa fa-dot-circle-o"
		]);		
		
	}

	/**
	 * truncates the table before seeding
	 * @return type
	 */
	private function cleanUp()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		DB::table('component_type')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}