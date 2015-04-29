<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComponentType extends Model {

	protected $table = 'component_type';
	protected $fillable = ['title', 'caption', 'icon', 'class_name'];
	protected $hidden = [];


	/**
	 * Components Replation
	 * @return type
	 */
	public function components()
	{
		return $this->hasMany('App\Models\Component');
	}


}
