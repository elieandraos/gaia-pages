<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model {

	protected $table = 'template';
	protected $fillable = ['title', 'display'];
	protected $hidden = [];

	/**
	 * Section Relation
	 * @return type
	 */
	public function sections()
	{
		return $this->hasMany('App\Models\Section');
	}

	/**
	 * Page Relation
	 * @return type
	 */
	public function pages()
	{
		return $this->hasMany('App\Models\Page');
	}

}
