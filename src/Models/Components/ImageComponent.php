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
	 * Render the component form row in the page create
	 * @return type
	 */
	public function renderFormRow($pageId)
	{
		$component_page = $this->component->componentPages()->first();

		if(isset($component_page)) 
		{
			//get the small preview thumb if image is uploaded
			$mediaItems = MediaLibrary::getCollection($component_page, $component_page->getMediaCollectionName(), []);
			(count($mediaItems))?$thumbUrl = $mediaItems[0]->getURL('thumb-xs'):$thumbUrl = null; 
		}
		else
		{
			$thumbUrl = null;
			$component_page = null;
		}

		$data = ['component' => $this->component, 'component_page' => $component_page, 'pageId' => $pageId, 'thumbUrl' => $thumbUrl];
		$view = View::make('admin.templates.components._image_form_row', $data );
		return $view->render();
	} 

}