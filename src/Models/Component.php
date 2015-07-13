<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class Component extends Model {

	protected $table = 'component';
	protected $fillable = ['title', 'order','unique_id', 'options', 'component_type_id', 'section_id'];
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
	 * Get the posts associated with the given component
	 * @return type
	 */
	public function posts()
	{
		return $this->belongsToMany('App\Models\Post');
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
	 * ComponentPage Relation
	 * @return type
	 */
	public function componentPosts()
	{
		return $this->hasMany('App\Models\ComponentPost');
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
	 * Renders the form row of the component
	 * @param type $type 'page' or 'post'
	 * @param type $id null for create, post_id or page_id for edit 
	 * @return type
	 */
	public function renderFormRow($type = 'page', $id = null)
	{
		$namespace = 'App\Models\Components';
		$className = "\\".$this->componentType->class_name;
		$class =  $namespace.$className;
		$object = new $class;
		$object->setComponent($this);

		return $object->renderFormRow($type, $id);

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
	 * Returns the first ComponentPage of the component_page table 
	 * @param type $page_id 
	 * @return type
	 */
	public function getComponentPage($page_id)
	{
		return $this->componentPages()->first();
	}



	/**
	 * Returns the first ComponentPost of the component_post table
	 * @param type $post_id 
	 * @return type
	 */
	public function getComponentPost($post_id)
	{
		return $this->componentPosts()->where('post_id', '=', $post_id)->first();
	}	

}
