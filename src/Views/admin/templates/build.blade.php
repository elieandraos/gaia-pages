@extends('admin.layout')

@section('content')

<div class="row">
	<div class="col-md-12">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
		    <li><a href="#">Dashboard</a></li>
		    <li>Templates</li>
		    <li class="active">Template Builder</li>
		</ul>

		<h1 class="h1">{{ $template->title}} | Build</h1>
	</div>
</div>

<div class="row">
	<div class="col-md-12">

		<!-- Panel start -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Custom Components Builder</h3>
			</div>
			<div class="panel-body">
				<input type="hidden" id="add-section-url" value="{{ $add_section_url }}" />	
				<input type="hidden" id="reorder-sections-url" value="{{ $reorder_sections_url }}" />	
				<input type="hidden" id="add-component-url" value="{{ $add_component_url }}" />
				<input type="hidden" id="reorder-components-url" value="{{ $reorder_components_url }}" />

				<!-- list of components types available -->
				@include('admin.templates._component_types')
				
				<!-- where all the building happens -->
				<div id="sections">
					@foreach($sections as $section)
						{!! $section->render() !!}
					@endforeach
				</div>
			</div>
		</div>
		<!-- Panel End -->

	</div>
</div>

@stop