<?php namespace App\Models\Components;

use App\Models\Component;
use View;

class ImageComponent extends Component {


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
		$view = View::make('admin.templates.components._image', ['component' => $this->component]);
		return $view->render();
	}


	/**
	 * Render the component form row in the page create
	 * @return type
	 */
	public function renderFormRow($pageId)
	{
		$component_page = $this->component->getPivot($pageId);
		if(isset($component_page)) 
		{
			$value  = $component_page->pivot->value;
			$params = $component_page->pivot->params;
		}
		else
		{
			$value = "";
			$params = [];
			$component_page = null;
		}

		$data = ['component' => $this->component, 'component_page' => $component_page, 'pageId' => $pageId, 'value' => $value];
		$view = View::make('admin.templates.components._image_form_row', $data );
		return $view->render();
	} 

}