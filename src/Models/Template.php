<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model {

	protected $table = 'template';
	protected $fillable = ['title', 'display'];
	protected $hidden = [];


	public function sections()
	{
		return $this->hasMany('App\Models\Section');
	}

}
