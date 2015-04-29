<?php namespace Gaia\Pages;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

//Repositories
use Gaia\Repositories\PageRepositoryInterface;
use Gaia\Repositories\TemplateRepositoryInterface;
//Requests
//use Gaia\Pages\TemplateRequest;
//Facades
use Redirect;
use Input;
//Models
use App\Models\Page;

class PageController extends Controller {

	
	protected $pageRepos, $templateRepos;
	
	public function __construct(PageRepositoryInterface $pageRepos, TemplateRepositoryInterface $templateRepos)
	{
		$this->pageRepos = $pageRepos;
		$this->templateRepos = $templateRepos;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$templates = $this->templateRepos->getAll()->lists('title', 'id');
		return view('admin.pages.create', ['templates' => $templates]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$input['slug'] = str_slug($input['title']);
		$page = $this->pageRepos->create($input); 
		return Redirect::route('admin.pages.edit', $page->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$page = $this->pageRepos->find($id);
		$sections = $this->templateRepos->getSectionsByOrder($page->template_id);
		return view('admin.pages.edit', ['page' => $page, 'sections' => $sections]);

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();
		dd($input);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
