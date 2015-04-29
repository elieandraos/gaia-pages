<?php namespace Gaia\Repositories; 

use App\Models\ComponentType;

class ComponentTypeRepository extends DbRepository implements ComponentTypeRepositoryInterface 
{
	
	/**
	 * Returns all the component types
	 * @return NewsCollection
	 */
	public function getAll()
	{	
		return ComponentType::get();
	}

}

?>