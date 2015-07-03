<?php namespace Gaia\Pages;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//Servies
use Gaia\Services\PageService;
//Repositories
use Gaia\Repositories\PageRepositoryInterface;
use Gaia\Repositories\TemplateRepositoryInterface;
use Gaia\Repositories\PostTypeRepositoryInterface;
//Facades
use Redirect;
use Input;
use Auth;
use App;
use MediaLibrary;
use Flash;
use View;
//Models
use App\Models\Page;
use App\Models\Seo;
use App\Models\Locale;


class PageController extends Controller {

	
	protected $pageRepos, $templateRepos;

	
	public function __construct(PageRepositoryInterface $pageRepos, TemplateRepositoryInterface $templateRepos, PageService $pageService, PostTypeRepositoryInterface $postTypeRepositoryInterface )
	{
		$this->pageRepos = $pageRepos;
		$this->templateRepos = $templateRepos;
		$this->pageService = $pageService;
		$this->authUser = Auth::user();

		//localization
		$this->locales = Locale::where('language', '!=', 'en')->lists('language', 'language');
		$this->first_locale = array_first($this->locales, function(){return true;});

		//share the post type submenu to the layout
		$this->postTypeRepos = $postTypeRepositoryInterface;
		View::share('postTypesSubmenu', $this->postTypeRepos->renderMenu());
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!$this->authUser->can('list-pages') && !$this->authUser->is('superadmin'))
			App::abort(403, 'Access denied');

		$pages = $this->pageRepos->getAll();
		return view('admin.pages.index', ["pages" => $pages, "locale" => $this->first_locale]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!$this->authUser->can('create-edit-pages') && !$this->authUser->is('superadmin'))
			App::abort(403, 'Access denied');

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
		if(!$this->authUser->can('create-edit-pages') && !$this->authUser->is('superadmin'))
			App::abort(403, 'Access denied');

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
		if(!$this->authUser->can('create-edit-pages') && !$this->authUser->is('superadmin'))
			App::abort(403, 'Access denied');

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
		if(!$this->authUser->can('create-edit-pages') && !$this->authUser->is('superadmin'))
			App::abort(403, 'Access denied');

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
		if(!$this->authUser->can('delete-pages') && !$this->authUser->is('superadmin'))
			App::abort(403, 'Access denied');

		$this->pageRepos->delete($id);
	}


	/**
	 * Translate the translatable fields 
	 * @param type $news 
	 * @return type
	 */
	public function translate($id, $locale)
	{
		if(!$this->authUser->can('translate-pages') && !$this->authUser->is('superadmin'))
			App::abort(403, 'Access denied');

		App::setLocale($locale);
		$page = $this->pageRepos->find($id);
		$sections = $this->templateRepos->getSectionsByOrder($page->template_id);
		return view('admin.pages.translate', ['page' => $page, 'sections' => $sections, "seo" => $page->seo, 'locales' => $this->locales, 'locale' => $locale]);

	}


	/**
	 * Save the translated content of the news
	 * @param type $news 
	 * @param type $locale 
	 * @return type
	 */
	public function translateStore($id, $locale)
	{
		if(!$this->authUser->can('translate-pages') && !$this->authUser->is('superadmin'))
			App::abort(403, 'Access denied');

		App::setLocale($locale);
		$input = Input::all();
		$page = $this->pageRepos->update($id, $input);
		$page->seo->updateFromInput($input);
		App::setLocale("en");
		
		Flash::success('Page was translated successfully.');
		return Redirect::route('admin.pages.index');
	}


}
