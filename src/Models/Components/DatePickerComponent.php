<?php namespace App\Models\Components;

use App\Models\Component;
use View;

class DatePickerComponent extends Component {


	protected $component;

	
	public function setComponent($component)
	{
		$this->component = $component;
	}

	/**
	 * Renders the component in the template builder
	 * @return type
	 */
	public function render()
	{
		$view = View::make('admin.templates.components._datepicker', ['component' => $this->component]);
		return $view->render();
	}

	/**
	 * Render the component form row in the page create
	 * @return type
	 */
	public function renderFormRow($pageId)
	{
		$component_page =  $this->component->componentPages()->first();

		if(isset($component_page)) 
		{
			$value  = $component_page->value;
			$params = $component_page->params;
		}
		else
		{
			$value = "";
			$params = [];
		}

		$view = View::make('admin.templates.components._datepicker_form_row', ['component' => $this->component, 'value' => $value]);
		return $view->render();
	} 
}