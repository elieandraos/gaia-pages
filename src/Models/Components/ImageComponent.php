<?php namespace App\Models\Components;

use App\Models\Component;
use View;
use MediaLibrary;

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
	 * Render the component form row in the page or post create
	 * @param type $type 
	 * @param type $id post_id or page_id, can be null for create case
	 * @return type
	 */
	public function renderFormRow($type = 'page', $id = null)
	{
		//cp can be ComponentPage or ComponentPost objects
		if($type == 'post')
			$cp = $this->component->getComponentPost($id);
		else 
			$cp = $this->component->componentPages()->first();

		if(isset($cp)) 
		{
			//get the small preview thumb if image is uploaded
			$mediaItems = MediaLibrary::getCollection($cp, $cp->getMediaCollectionName(), []);
			(count($mediaItems))?$thumbUrl = $mediaItems[0]->getURL('thumb-xs'):$thumbUrl = null; 
		}
		else
		{
			$thumbUrl = null;
			$cp = null;
		}

		$data = ['component' => $this->component, 'cp' => $cp, 'thumbUrl' => $thumbUrl];
		$view = View::make('admin.templates.components._image_form_row', $data );
		return $view->render();
	} 

}