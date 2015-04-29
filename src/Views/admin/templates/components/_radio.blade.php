<div class="component clearfix" data-component-id="{{ $component->id}}" data-section-id="{{ $component->section_id }}" id="cp_{{$component->id}}">
	
	<!-- icon -->
	<i class="{{ $component->componentType->icon }}"></i>

	<!-- title update -->
	<a href="#" class="component-title" 
	   data-type="text" 
	   data-pk="{{$component->id}}"  
	   data-url="{{ URL::route('admin.pages.templates.update-component-title', $component->section->template_id) }}" 
	   data-title="Enter text field title"
	   data-emptytext="Update field title"
	>
		{{ $component->title }} 
	</a>

	<!-- title update -->
	<a href="#" class="component-options" 
	   data-type="textarea" 
	   data-pk="{{$component->id}}"  
	   data-url="{{ URL::route('admin.pages.templates.update-component-options', $component->section->template_id) }}" 
	   data-title="Enter options (one per line)"
	   data-emptytext="Add Options"
	>
		{{ str_replace('<br />', '', $component->options) }}  
	</a>

	<!-- info -->
	<span class="component-desc">This component will generate radio button(s)</span>

	
	<!-- delete component-->
	<a  href="#" class="pull-right remove-component" 
	    data-url="{{ URL::route('admin.pages.templates.delete-component', $component->section->template_id)}}"
		data-component-id="{{ $component->id}}" 
	>
		<i class="fa fa-times"></i>
	</a>

</div>