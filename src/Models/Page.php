<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

	protected $table = 'page';
	protected $fillable = ['title', 'slug', 'description', 'template_id'];
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
	 * Get the components associated with the given page
	 * @return type
	 */
	public function components()
	{
		return $this->belongsToMany('App\Models\Component')->withPivot('value', 'params');
	}


	/**
	 * Morphing to Seo Model
	 * @return type
	 */
	public function seo()
	{
	    return $this->morphOne('App\Models\Seo', 'seoable');
	}

}
