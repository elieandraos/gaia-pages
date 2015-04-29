<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use View;

class Section extends Model {

	protected $table = 'section';
	protected $fillable = ['title', 'order', 'template_id'];
	protected $hidden = [];

	/**
	 * Template Relation
	 * @return type
	 */
	public function template()
	{
		return $this->belongsTo('App\Models\Template');
	}


	/**
	 * Component Relation
	 * @return type
	 */
	public function components()
	{
		return $this->hasMany('App\Models\Component');
	}

	public function getComponentsByOrder()
	{
		return $this->components()->orderBy('order')->get();
	}
	
	/**
	 * Renders the html content of a section inside the template builder
	 * @return type
	 */
	public function render()
	{
		$view = View::make('admin.templates.html_section', ['section' => $this]);
		return $view->render();
	}

}
