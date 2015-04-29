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

}
