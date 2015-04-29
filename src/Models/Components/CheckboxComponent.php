<?php namespace App\Models\Components;

use App\Models\Component;
use View;

class CheckboxComponent extends Component {


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
		$view = View::make('admin.templates.components._checkbox', ['component' => $this->component]);
		return $view->render();
	}

	/**
	 * Render the component form row in the page create
	 * @return type
	 */
	public function renderFormRow()
	{
		$options = $this->component->optionsToArray();
		$view = View::make('admin.templates.components._checkbox_form_row', ['component' => $this->component, 'options' => $options]);
		return $view->render();
	} 

}