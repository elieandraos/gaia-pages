<div class='section' data-section-id="{{$section->id}}" data-template-id="{{$section->template_id}}" id="{{ $section->id }}">
	<div class="section-actions">
		<a class="drag-section" href="#" data-toggle="tooltip" data-placement="top" title="Drag to reoreder sections"><i class="fa fa-bars"></i></a>
		<a  href="#" class="remove-section" 
		    data-url="{{ URL::route('admin.pages.templates.delete-section', $section->template_id)}}"
			data-section-id="{{ $section->id}}" 
		>
			<i class="fa fa-times"></i>
		</a>
	</div>

	<a href="#" class="section_title" 
	   data-type="text" 
	   data-pk="{{$section->id}}"  
	   data-url="{{ URL::route('admin.pages.templates.update-section-title', $section->template_id) }}" 
	   data-title="Enter section title"
	   data-emptytext="Update section title"
	>
		{!! $section->title !!}
	</a>

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class='section-components'>
				@foreach($section->getComponentsByOrder() as $cp)
					{!! $cp->render() !!} 
				@endforeach
			</div>
		</div>
	</div>
</div>