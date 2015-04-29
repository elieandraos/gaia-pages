<?php namespace Gaia\Repositories; 

use App\Models\Page;

class PageRepository extends DbRepository implements PageRepositoryInterface 
{
	
	/**
	 * Returns all the Pages
	 * @return PagesCollection
	 */
	public function getAll()
	{	
		return Page::orderBy('created_at')->get();
	}

	/**
	 * Find Page by Id
	 * @param type $id 
	 * @return type
	 */
	public function find($id)
	{
		return Page::findOrFail($id);
	}

	/**
	 * Create a page
	 * @param type $input 
	 * @return type
	 */
	public function create($input)
	{
		return Page::create($input);
	}

}

?>