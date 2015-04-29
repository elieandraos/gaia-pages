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

}