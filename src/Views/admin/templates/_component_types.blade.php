<div class="components-types">
	<ul class="clearfix">
		@foreach($component_types as $component_type)
			<li data-toggle="tooltip" data-placement="top" title="{{$component_type->caption }}" data-component-type-id="{{$component_type->id}}" class="component-type">
				<i class="{{$component_type->icon }}"></i>
				{!! $component_type->title !!}
			</li>
		@endforeach
			<li data-toggle="tooltip" data-placement="top" title="Adds a placeholder for the components" id="add-section">
				<i class="fa fa-folder-o"></i>
				Section
			</li>
	</ul> 
</div>