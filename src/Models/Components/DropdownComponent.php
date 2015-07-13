<?php namespace App\Models\Components;

use App\Models\Component;
use View;

class DropdownComponent extends Component {


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
		$view = View::make('admin.templates.components._dropdown', ['component' => $this->component]);
		return $view->render();
	}


	/**
	 * Render the component form row in the page or post create
	 * @param type $type 
	 * @param type $id post_id or page_id, can be null for create case
	 * @return type
	 */
	public function renderFormRow($type = 'page', $id = null)
	{
		$options = $this->component->optionsToArray();
		
		//cp can be ComponentPage or ComponentPost objects
		if($type == 'post')
			$cp = $this->component->getComponentPost($id);
		else 
			$cp = $this->component->componentPages()->first();
		
		if(isset($cp)) 
		{
			$value  = explode(",",$cp->value);
			$params = $cp->params;
		}
		else
		{
			$value = [];
			$params = [];
		}

		$view = View::make('admin.templates.components._dropdown_form_row', ['component' => $this->component, 'options' => $options, 'value' => $value]);
		return $view->render();
	} 
}