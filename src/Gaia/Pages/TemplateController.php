<?php namespace Gaia\Pages;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

//Repositories
use Gaia\Repositories\ComponentTypeRepositoryInterface;
use Gaia\Repositories\TemplateRepositoryInterface;
use Gaia\Repositories\PostTypeRepositoryInterface;
//Requests
use Gaia\Pages\TemplateRequest;
//Facades
use Redirect;
use Input;
use Auth;
use App;
use View;
//Models
use App\Models\Section;
use App\Models\Component;


class TemplateController extends Controller {

	protected $componentTypeRepos, $templateRepos, $authUser;
	

	public function __construct(ComponentTypeRepositoryInterface $componentTypeRepos, TemplateRepositoryInterface $templateRepos, PostTypeRepositoryInterface $postTypeRepositoryInterface)
	{
		$this->componentTypeRepos = $componentTypeRepos;
		$this->templateRepos = $templateRepos;
		$this->authUser = Auth::user();

		//share the post type submenu to the layout
		$this->postTypeRepos = $postTypeRepositoryInterface;
		View::share('postTypesSubmenu', $this->postTypeRepos->renderMenu());
	}


	/**
	 * List all the templates
	 * @return type
	 */
	public function index()
	{
		if(!$this->authUser->can('list-page-templates') && !$this->authUser->is('superadmin'))
			App::abort(403, 'Access denied');

		$templates = $this->templateRepos->getAll();
		return view('admin.templates.index', ['templates' => $templates]);
	}
	
	/**
	 * Show the form for creating a new page template.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!$this->authUser->can('create-edit-page-templates') && !$this->authUser->is('superadmin'))
			App::abort(403, 'Access denied');
		
		return view('admin.templates.create');
	}

	
	/**
	 * Save the page template
	 *  
	 * @return Response
	 */
	public function store(TemplateRequest $request)
	{
		if(!$this->authUser->can('create-edit-page-templates') && !$this->authUser->is('superadmin'))
			App::abort(403, 'Access denied');

		$input = $request->all();
		$template = $this->templateRepos->create($input); 

		return Redirect::route('admin.pages.templates.build', $template->id);
	}


	/**
	 * Build the page custom components
	 * @param int $templateId 
	 * @return Response
	 */
	public function build($templateId)
	{
		
		if(!$this->authUser->can('create-edit-page-templates') && !$this->authUser->is('superadmin'))
			App::abort(403, 'Access denied');

		$template = $this->templateRepos->find($templateId);
		$component_types = $this->componentTypeRepos->getAll();
		$sections = $this->templateRepos->getSectionsByOrder($templateId);
		$add_section_url = route('admin.pages.templates.add-section', $templateId);
		$reorder_sections_url = route('admin.pages.templates.reorder-sections', $templateId);
		$add_component_url = route('admin.pages.templates.add-component', $templateId);
		$reorder_components_url = route('admin.pages.templates.reorder-components', $templateId);

		$data = [ 
					'component_types'      => $component_types, 
					'sections'			   => $sections,
					'template' 			   => $template, 
					'add_section_url' 	   => $add_section_url,
					'reorder_sections_url' => $reorder_sections_url,
					'add_component_url'    => $add_component_url,
					'reorder_components_url' => $reorder_components_url
			    ];

		return view('admin.templates.build', $data);
	}


	/**
	 * Add a section to the template
	 * @param type $templateId 
	 * @return type
	 */
	public function storeSection($templateId)
	{
		if(!$this->authUser->can('create-edit-page-templates') && !$this->authUser->is('superadmin'))
			App::abort(403, 'Access denied');

		$section = $this->templateRepos->addEmptySection($templateId);
		return $section->render();
	}


	/**
	 * Updates the section title
	 * @return type
	 */
	public function updateSectionTitle($templateId)
	{
		if(!$this->authUser->can('create-edit-page-templates') && !$this->authUser->is('superadmin'))
			App::abort(403, 'Access denied');

		 $inputs = Input::all();
         $section = $this->templateRepos->findSection($inputs['pk']);
         $section->title = $inputs['value'];
         $section->save();
	}


	/**
	 * Reorder sections inside the template
	 * @param type $templateId 
	 * @return type
	 */
	public function reorderSections($templateId)
	{
		if(!$this->authUser->can('create-edit-page-templates') && !$this->authUser->is('superadmin'))
			App::abort(403, 'Access denied');

		$inputs = Input::all();
		if(isset($inputs['data']) && count($inputs['data']))
		{
			foreach($inputs['data'] as $order => $id)
			{
				$section = $this->templateRepos->findSection($id);
				$section->order = $order;
				$section->save();
			}
		}
	}


	/**
	 * Adds a component into a section
	 * @param type $templateId 
	 * @return type
	 */
	public function storeComponent($templateId)
	{
		if(!$this->authUser->can('create-edit-page-templates') && !$this->authUser->is('superadmin'))
			App::abort(403, 'Access denied');

		$inputs = Input::all();
		$component = $this->templateRepos->addComponent($inputs);
		return $component->render();
	}


	/**
	 * Update a component title
	 * @param type $templateId 
	 * @return type
	 */
	public function updateComponentTitle($templateId)
	{
		 
		if(!$this->authUser->can('create-edit-page-templates') && !$this->authUser->is('superadmin'))
			App::abort(403, 'Access denied');

		 $inputs = Input::all();
         $component = $this->templateRepos->findComponent($inputs['pk']);
         $component->title = $inputs['value'];
         $component->save();
	}


	/**
	 * Reorder components inside a section
	 * @param type $templateId 
	 * @return type
	 */
	public function reorderComponents($templateId)
	{
		$inputs = Input::all();
		
		if(isset($inputs['data']) && count($inputs['data']))
		{
			foreach($inputs['data'] as $order => $id)
			{
				$id = (int)str_replace("cp_", "", $id);
				$component = $this->templateRepos->findComponent($id);
				$component->order = $order;
				$component->save();
			}
		}
	}


	/**
	 * Delete a component
	 * @param type $templateId 
	 * @return type
	 */
	public function destroyComponent($templateId)
	{
		
		if(!$this->authUser->can('create-edit-page-templates') && !$this->authUser->is('superadmin'))
			App::abort(403, 'Access denied');

		$inputs = Input::all();
		$component = $this->templateRepos->findComponent($inputs['id']);
		$component->delete();
	}


	/**
	 * Delete a section
	 * @param type $templateId 
	 * @return type
	 */
	public function destroySection($templateId)
	{
		if(!$this->authUser->can('create-edit-page-templates') && !$this->authUser->is('superadmin'))
			App::abort(403, 'Access denied');

		$inputs = Input::all();
		$section = $this->templateRepos->findSection($inputs['id']);
		$section->delete();
	}


	/**
	 * Updates the component options
	 * @param type $templateId 
	 * @return type
	 */
	public function updateComponentOptions($templateId)
	{
		if(!$this->authUser->can('create-edit-page-templates') && !$this->authUser->is('superadmin'))
			App::abort(403, 'Access denied');

		$inputs = Input::all();
		$component = $this->templateRepos->findComponent($inputs['pk']);
        $component->options = nl2br($inputs['value']);
        $component->save();
	}


	/**
	 * Delete a page template
	 * @param type $templateId 
	 * @return type
	 */
	public function destroy($templateId)
	{
		if(!$this->authUser->can('delete-page-templates') && !$this->authUser->is('superadmin'))
			App::abort(403, 'Access denied');

		$template = $this->templateRepos->find($templateId);
		$template->delete();
	}
	

}
