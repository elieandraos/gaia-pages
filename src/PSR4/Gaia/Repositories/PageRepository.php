<?php namespace Gaia\Repositories; 

use App\Models\Page;
use App\Models\Component;
use Input;
use Gaia\Services\PageService;

class PageRepository extends DbRepository implements PageRepositoryInterface 
{
	
	protected $pageService;
	/**
	 * Returns all the Pages
	 * @return PagesCollection
	 */
	public function getAll()
	{	
		return Page::orderBy('created_at')->get();
	}


	/**
	 * Find Page by Id
	 * @param type $id 
	 * @return type
	 */
	public function find($id)
	{
		return Page::findOrFail($id);
	}


	/**
	 * Create a page
	 * @param type $input 
	 * @return type
	 */
	public function create($input)
	{
		return Page::create($input);
	}


	/**
	 * Delete the page
	 * @param int $id 
	 * @return 
	 */
	public function delete($id)
	{
		$page = $this->find($id);
		$page->delete();
	}


	/**
	 * Update a page object
	 * @param int $id 
	 * @param type $input 
	 * @return News
	 */
	public function update($id, $input)
	{
		$page = $this->find($id);
		$this->pageService = new PageService;
		//Remove images first if remove_image checkbox is set
		if(isset($input['remove_image']))
		{
			foreach($input['remove_image'] as $key => $component_id)
			{
				$component = Component::find($component_id);
				$component_page = $component->getPivot($id);
				$imageName = $component_page->pivot->value;
				$this->pageService->removeImage($page, $imageName);
				$page->components()->detach($component_id);
			}
		}
		//keys from the input array to get rid of (seo keys, page original fields...)
		$except = ['_token', 'title', 'slug', 'description', 'remove_image', 'meta_title', 'meta_description', 'meta_keywords', 'facebook_title', 'facebook_description', 'twitter_title', 'twitter_description'];
		//get the components ids from inputs and update their values
		$components = array_except($input, $except);

		if(is_array($components) && count($components))
		{
			foreach($components as $key => $val)
		 	{
		 		if(Input::hasFile($key))
		 		{
		 			//upload the image and save the value
		 			$filename = $this->pageService->uploadImage($page, $input[$key]);
		 			$id = (int)str_replace("cp_", "", $key);
		 			$page->components()->detach($id);
			 		$page->components()->attach([$id => ['value' => $filename]]);
		 		}
		 		else
		 		{
			 		//update values of $_POST
			 		$id = (int)str_replace("cp_", "", $key);
			 		(is_array($val))?$value = implode(",", $val):$value=$val; //in case of checkbox type, implode the array to string
			 		$page->components()->detach($id);
			 		$page->components()->attach([$id => ['value' => $value]]);
			 	}
		 	}
		 }
		//save the page
		$page->update($input); 
		return $page;
	}

}

?>