<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
	public function renderFormRow()
	{
		$namespace = 'App\Models\Components';
		$className = "\\".$this->componentType->class_name;
		$class =  $namespace.$className;
		$object = new $class;
		$object->setComponent($this);
		return $object->renderFormRow();

	}


	/**
	 * Transforms the options field into an array
	 * @return type
	 */
	public function optionsToArray()
	{
		return explode( '<br />', $this->options);
	}


}
