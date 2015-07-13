<?php namespace Gaia\Repositories; 

use App\Models\Template;
use App\Models\Section;
use App\Models\Component;

class TemplateRepository extends DbRepository implements TemplateRepositoryInterface 
{
	
	protected $limit = 12;

	/**
	 * Returns all the pages templates
	 * @return NewsCollection
	 */
	public function getAll($type = 'page')
	{	
		return Template::orderBy('title')->where('type', '=', $type)->paginate($this->limit);
	}


	/**
	 * Returns all the templates (not filtered by type)
	 * @return type
	 */
	public function getAllTypes()
	{
		return Template::orderBy('title')->paginate($this->limit);
	}


	/**
	 * Returns one template by id
	 * @param int $id 
	 * @return News
	 */
	public function find($id)
	{
		return Template::findOrFail($id);
	}


	/**
	 * Create a template object
	 * @param array $input 
	 * @return News
	 */
	public function create($input)
	{
		return Template::create($input);
	}


	/**
	 * Adds an empty section to the template
	 * @param type $templateId 
	 * @return type
	 */
	public function addEmptySection($templateId)
	{
		return Section::create(['title' => '', 'order' => 0, 'template_id' => $templateId ]);
	}


	/**
	 * Get the template's sections by order
	 * @param type $templateId 
	 * @return type
	 */
	public function getSectionsByOrder($templateId)
	{
		return Section::where('template_id', '=', $templateId)->orderBy('order')->get();
	}


	/**
	 * Find a section
	 * @param type $section_id 
	 * @return type
	 */
	public function findSection($sectionId)
	{
		return Section::findOrFail($sectionId);
	}


	/**
	 * Find a component
	 * @param type $componentId 
	 * @return type
	 */
	public function findComponent($componentId)
	{
		return Component::findOrFail($componentId);
	}


	/**
	 * Add a component
	 * @param type $templateId 
	 * @return type
	 */
	public function addComponent($input)
	{
		return Component::create($input);
	}
}

?>