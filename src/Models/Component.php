<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class Component extends Model {

	protected $table = 'component';
	protected $fillable = ['title', 'order', 'options', 'component_type_id', 'section_id'];
	protected $hidden = [];

	/**
	 * Section Relation
	 * @return type
	 */
	public function section()
	{
		return $this->belongsTo('App\Models\Section');
	}


	/**
	 * Component Type Relation
	 * @return type
	 */
	public function componentType()
	{
		return $this->belongsTo('App\Models\ComponentType');
	}


	/**
	 * Get the pages associated with the given component
	 * @return type
	 */
	public function pages()
	{
		return $this->belongsToMany('App\Models\Page');
	}


	/**
	 * ComponentPage Relation
	 * @return type
	 */
	public function componentPages()
	{
		return $this->hasMany('App\Models\ComponentPage');
	}


	/**
	 * Render the component in the template ui
	 * @return type
	 */
	public function render()
	{
		$namespace = 'App\Models\Components';
		$className = "\\".$this->componentType->class_name;
		$class =  $namespace.$className;
		$object = new $class;
		$object->setComponent($this);
		return $object->render();
	}


	/**
	 * Renders the form row in the create page
	 * @return type
	 */
	public function renderFormRow($pageId)
	{
		$namespace = 'App\Models\Components';
		$className = "\\".$this->componentType->class_name;
		$class =  $namespace.$className;
		$object = new $class;
		$object->setComponent($this);
		return $object->renderFormRow($pageId);

	}


	/**
	 * Transforms the options field of the componentType object into an array 
	 * (used for options edit in place in page templates)
	 * @return type
	 */
	public function optionsToArray()
	{
		return explode( '<br />', $this->options);
	}


	/**
	 * Returns the first ComponentPage of the componentPages() eloquent Relations
	 * @return type
	 */
	public function getComponentPage()
	{
		return $this->componentPages()->first();
	}


	/**
     * Returns the image thumb relative url of a component inside a page
     * @param type $size 
     * @return type
     */
    public function getThumbUrl($pageId, $imageName, $size = 'xs')
    {
    	return "uploads/pages/".$pageId."/thumb-".$size."-".$imageName;
    }


}
