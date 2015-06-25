<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

	protected $table = 'page';
	protected $fillable = ['title', 'slug', 'description', 'template_id'];
	protected $hidden = [];
	//for Component page build
	protected $except = ['_token', 'title', 'slug', 'description', 'remove_image', 'meta_title', 'meta_description', 'meta_keywords', 'facebook_title', 'facebook_description', 'twitter_title', 'twitter_description'];

	/**
	 * Template Relation
	 * @return type
	 */
	public function template()
	{
		return $this->belongsTo('App\Models\Template');
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
	 * Morphing to Seo Model
	 * @return type
	 */
	public function seo()
	{
	    return $this->morphOne('App\Models\Seo', 'seoable');
	}


	/**
	 * Returns an array of Component ids with their values repsectively.
	 * Done in PageController@edit. 
	 * @param type $input 
	 * @return type
	 */
	public function retrieveComponentIds($input)
	{
		//get the components ids from inputs and update their values
		$componentIds = array_except($input, $this->except);
		$array = [];

		if(is_array($componentIds) && count($componentIds))
		{
			foreach($componentIds as $key => $val)
			{
				$id = (int)str_replace("cp_", "", $key);
			 	(is_array($val))?$value = implode(",", $val):$value=$val; //in case of checkbox type, implode the array to string
			 	$array[$id] = ['value' => $value];
			}
		}

		return $array;
	}

}