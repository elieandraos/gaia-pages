<?php namespace Gaia\Pages;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//Servies
use Gaia\Services\PageService;
//Repositories
use Gaia\Repositories\PageRepositoryInterface;
use Gaia\Repositories\TemplateRepositoryInterface;
//Facades
use Redirect;
use Input;
//Models
use App\Models\Page;
use App\Models\Seo;

class PageController extends Controller {

	
	protected $pageRepos, $templateRepos;

	
	public function __construct(PageRepositoryInterface $pageRepos, TemplateRepositoryInterface $templateRepos, PageService $pageService )
	{
		$this->pageRepos = $pageRepos;
		$this->templateRepos = $templateRepos;
		$this->pageService = $pageService;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$pages = $this->pageRepos->getAll();
		return view('admin.pages.index', ["pages" => $pages]);
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
		
		$seo = new Seo;
		$page->seo()->save($seo);

		return Redirect::route('admin.pages.edit', $page->id);
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
		return view('admin.pages.edit', ['page' => $page, 'sections' => $sections, "seo" => $page->seo]);

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
		$page = $this->pageRepos->update($id, $input);
		$page->seo->updateFromInput($input);
		return Redirect::route('admin.pages.index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->pageRepos->delete($id);
	}

}
